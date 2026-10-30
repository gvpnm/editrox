<?php

namespace APP\plugins\themes\editroxTheme;

use PKP\plugins\ThemePlugin;
use PKP\plugins\HookRegistry;

class EditroxThemePlugin extends ThemePlugin {

    public function init() {
        $this->setParent('defaultthemeplugin');

        // 1. Preset Layout Selector (3 Pre-Customized Modern Designs)
        $this->addOption('designPreset', 'FieldOptions', [
            'type' => 'radio',
            'label' => 'Editrox Visual Design Preset',
            'description' => 'Choose a pre-customized architectural layout and color palette across all journal pages.',
            'options' => [
                [
                    'value' => 'modern-portal',
                    'label' => 'Preset 1: Modern Academic Portal (Navy/Royal Blue, Split Hero, Card Grids)'
                ],
                [
                    'value' => 'classic-ivory',
                    'label' => 'Preset 2: Classic Ivory & Serif (Warm Editorial, Centered Masthead, Crimson Accents)'
                ],
                [
                    'value' => 'swiss-minimal',
                    'label' => 'Preset 3: Swiss Minimalist Tech (High-Contrast Monochrome, Emerald Badges, Border Grid)'
                ],
            ],
            'default' => 'modern-portal'
        ]);

        // 2. Custom Portal Metadata Options
        $this->addOption('heroTagline', 'FieldText', [
            'label' => 'Homepage Hero Tagline',
            'default' => 'Advancing rigorous, open-access scholarship and global enterprise research.'
        ]);

        $this->addOption('metricReviewTime', 'FieldText', [
            'label' => 'KPI: Average First Decision',
            'default' => '21 Days'
        ]);

        $this->addOption('metricAcceptance', 'FieldText', [
            'label' => 'KPI: Acceptance Rate',
            'default' => '28%'
        ]);

        $this->addOption('metricIndexing', 'FieldText', [
            'label' => 'KPI: Indexing & Identifiers',
            'default' => 'Crossref DOI • OAI-PMH • OpenAlex'
        ]);

        $this->addOption('metricAccessModel', 'FieldText', [
            'label' => 'KPI: Publishing Model',
            'default' => 'Diamond / Gold Open Access'
        ]);

        // Load Base + Preset CSS
        $this->addStyle('editrox-css', 'styles/editrox.css');

        // Inject preset class and variables into Smarty templates
        HookRegistry::register('TemplateManager::display', [$this, 'injectThemeVariables']);
    }

    public function injectThemeVariables($hookName, $args) {
        $templateMgr = $args[0];
        $preset = $this->getOption('designPreset') ?: 'modern-portal';

        $templateMgr->assign([
            'editroxPreset'        => $preset,
            'editroxHeroTagline'   => $this->getOption('heroTagline') ?: 'Advancing rigorous, open-access scholarship.',
            'editroxReviewTime'    => $this->getOption('metricReviewTime') ?: '21 Days',
            'editroxAcceptance'    => $this->getOption('metricAcceptance') ?: '28%',
            'editroxIndexing'      => $this->getOption('metricIndexing') ?: 'Crossref DOI • OpenAlex',
            'editroxAccessModel'   => $this->getOption('metricAccessModel') ?: 'Open Access',
        ]);

        return false;
    }

    public function getDisplayName() {
        return 'Editrox Multi-Preset Journal Suite';
    }

    public function getDescription() {
        return 'Includes 3 pre-customized design presets and custom templates for Homepage, About, Issue Archive, Submissions & Article Tracking, and Login.';
    }
}
