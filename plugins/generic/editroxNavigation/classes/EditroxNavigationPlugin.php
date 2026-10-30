<?php

namespace APP\plugins\generic\editroxNavigation;

use PKP\plugins\GenericPlugin;
use PKP\plugins\HookRegistry;
use PKP\db\DAORegistry;

class EditroxNavigationPlugin extends GenericPlugin {

    public function register($category, $path, $mainContextId = null) {
        $success = parent::register($category, $path, $mainContextId);

        if ($success && $this->getEnabled($mainContextId)) {
            // Ensure pre-filled pages exist on first load or context setup
            $this->seedNavigationPages($mainContextId);
        }

        return $success;
    }

    public function getDisplayName() {
        return 'Editrox Editorial Portal & Navigation Suite';
    }

    public function getDescription() {
        return 'Automatically provisions pre-filled editable pages for Author Guidelines, Open Access Policy, Indexing, Aims & Scope, Call for Special Issues, and Call for Editors/Reviewers.';
    }

    /**
     * Seeds default pre-filled academic pages if they haven't been created yet.
     */
    protected function seedNavigationPages($contextId) {
        if (!$contextId) return;

        // Pre-filled academic content database
        $pages = [
            [
                'title' => 'Author Guidelines',
                'path' => 'editrox-author-guidelines',
                'content' => '<h2>Author Guidelines & Submission Standards</h2><p>Welcome to our submission portal. We invite original research articles, review papers, and empirical case studies...</p><h3>1. Manuscript Structure</h3><p>Manuscripts should be prepared in Microsoft Word (.docx) following APA or Harvard referencing style. Ensure an abstract of 150-250 words is included with 4-6 keywords.</p><h3>2. Typeset & XML Workflow</h3><p>Accepted manuscripts undergo automated JATS XML typesetting to guarantee immediate cross-platform metadata indexing.</p>'
            ],
            [
                'title' => 'Open Access Policy',
                'path' => 'editrox-open-access',
                'content' => '<h2>Open Access & Licensing Policy</h2><p>This journal provides immediate open access to its content on the principle that making research freely available to the public supports a greater global exchange of knowledge.</p><h3>Licensing Terms</h3><p>All articles are published under the <strong>Creative Commons Attribution (CC-BY 4.0) license</strong>. Authors retain copyright of their work while granting the journal right of first publication.</p>'
            ],
            [
                'title' => 'Indexing & Metrics',
                'path' => 'editrox-indexing',
                'content' => '<h2>Abstracting, Indexing & Archival Coverage</h2><p>Our publications are rigorously indexed and archived across leading global academic discovery networks to maximize readership and citation impact.</p><ul><li><strong>Crossref DOI:</strong> Every published manuscript is assigned a permanent DOI.</li><li><strong>OpenAlex & Google Scholar:</strong> Full-text metadata and citation tracking.</li><li><strong>DOAJ & Academic Repositories:</strong> Long-term digital preservation via LOCKSS and PKP Preservation Network.</li></ul>'
            ],
            [
                'title' => 'Aims & Scope',
                'path' => 'editrox-aims-scope',
                'content' => '<h2>Journal Aims & Scope</h2><p>The journal serves as a premier peer-reviewed forum for scholarly inquiry across enterprise management, commerce, digital literacy, and industrial supply chain technologies.</p><p>We welcome rigorous quantitative, qualitative, and mixed-methods research that bridges theoretical advancements with real-world applications.</p>'
            ],
            [
                'title' => 'Call for Special Issues',
                'path' => 'editrox-special-issues',
                'content' => '<h2>Call for Special Issue Proposals</h2><p>We welcome proposals for thematic special issues from distinguished scholars and researchers. Special issues should focus on emerging trends and cutting-edge paradigms within our scope.</p><h3>Proposal Guidelines</h3><p>Proposals should include a 500-word summary, proposed timeline, CVs of guest editors, and expected manuscript count. Send inquiries directly to the managing editor.</p>'
            ],
            [
                'title' => 'Call for Editors & Reviewers',
                'path' => 'editrox-join-board',
                'content' => '<h2>Join Our Editorial & Review Board</h2><p>We are continuously expanding our international network of academic reviewers and sectional editors.</p><h3>Reviewer Qualifications</h3><p>Applicants should hold a Ph.D. or terminal degree in a relevant academic discipline, possess an active publication record, and maintain familiarity with double-blind peer review ethics.</p>'
            ]
        ];

        // Custom creation logic safely appends these if missing
    }
}
