<?php

namespace APP\plugins\generic\editrox;

use PKP\plugins\GenericPlugin;
use PKP\plugins\HookRegistry;
use APP\plugins\generic\editrox\src\DocxToJatsConverter;
use APP\plugins\generic\editrox\src\ReviewerMatcher;
use APP\plugins\generic\editrox\src\EarlyAccessManager;
use APP\plugins\generic\editrox\src\TieredBillingHandler;
use APP\plugins\generic\editrox\src\AnalyticsAggregator;

class EditroxPlugin extends GenericPlugin {

    public function register($category, $path, $mainContextId = null) {
        $success = parent::register($category, $path, $mainContextId);

        if ($success && $this->getEnabled($mainContextId)) {
            // Feature 1: Trigger DOCX -> JATS/HTML generation on file upload
            HookRegistry::register('FileManager::uploadFile::success', [$this, 'handleFileUpload']);

            // Feature 3: Inject reviewer discovery & conflict detection into review modal
            HookRegistry::register('Templates::Workflow::StageParticipants', [$this, 'injectReviewerDiscovery']);

            // Feature 4: Continuous publishing / Early access route hooks
            HookRegistry::register('Publication::publish', [$this, 'handleEarlyAccessPublish']);

            // Feature 5: Dynamic tiered APC billing based on World Bank author classification
            HookRegistry::register('PaymentManager::getAmount', [$this, 'applyTieredPricing']);

            // Feature 6: Inject live citations & readership metrics into article landing page
            HookRegistry::register('Templates::Article::Details', [$this, 'injectImpactDashboard']);
        }

        return $success;
    }

    public function getDisplayName() {
        return 'Editrox Editorial Suite';
    }

    public function getDescription() {
        return 'Integrated modules for automated JATS typesetting, reviewer discovery, early access, tiered APCs, and citation metrics.';
    }

    public function handleFileUpload($hookName, $args) {
        $file = $args[0] ?? null;
        if ($file && strtolower(pathinfo($file->getData('originalFileName'), PATHINFO_EXTENSION)) === 'docx') {
            $converter = new DocxToJatsConverter();
            $converter->convert($file);
        }
        return false;
    }

    public function injectReviewerDiscovery($hookName, $args) {
        $output =& $args[2];
        $submission = $args[0]['submission'] ?? null;
        if ($submission) {
            $matcher = new ReviewerMatcher();
            $recommendations = $matcher->findCandidates($submission);
            $output .= '<div class="editrox-reviewer-panel"><h4>Editrox Suggested Reviewers</h4>' . $recommendations . '</div>';
        }
        return false;
    }

    public function handleEarlyAccessPublish($hookName, $args) {
        $newPublication = $args[0];
        $earlyAccess = new EarlyAccessManager();
        $earlyAccess->processOnlineFirst($newPublication);
        return false;
    }

    public function applyTieredPricing($hookName, $args) {
        $amount =& $args[0];
        $paymentType = $args[1];
        $userId = $args[2] ?? null;

        if ($paymentType === 'PAYMENT_TYPE_PURCHASE_ARTICLE' || $paymentType === 'PAYMENT_TYPE_MEMBERSHIP') {
            $billing = new TieredBillingHandler();
            $amount = $billing->calculateAdjustedFee($amount, $userId);
        }
        return false;
    }

    public function injectImpactDashboard($hookName, $args) {
        $output =& $args[2];
        $article = $args[1]['publication'] ?? null;
        if ($article && $article->getData('doi')) {
            $analytics = new AnalyticsAggregator();
            $metricsHtml = $analytics->renderMetricsCard($article->getData('doi'));
            $output .= $metricsHtml;
        }
        return false;
    }
}
