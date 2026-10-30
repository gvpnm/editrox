{include file="frontend/components/header.tpl" pageTitleTranslated=$currentJournal->getLocalizedName()}

<div class="editrox-wrapper preset-{$editroxPreset|escape}">
    <section class="editrox-hero">
        <div class="editrox-container editrox-hero-grid">
            <div class="editrox-hero-content">
                <div class="editrox-hero-badges">
                    {if $currentJournal->getData('onlineIssn')}
                        <span class="editrox-badge">e-ISSN: {$currentJournal->getData('onlineIssn')|escape}</span>
                    {/if}
                    {if $currentJournal->getData('printIssn')}
                        <span class="editrox-badge">p-ISSN: {$currentJournal->getData('printIssn')|escape}</span>
                    {/if}
                    <span class="editrox-badge editrox-badge-accent">{$editroxAccessModel|escape}</span>
                </div>

                <h1 class="editrox-hero-title">{$currentJournal->getLocalizedName()|escape}</h1>
                <p class="editrox-hero-subtitle">{$editroxHeroTagline|escape}</p>

                <div class="editrox-hero-actions">
                    <a href="{url page="submissions"}" class="editrox-btn editrox-btn-primary">Submit Manuscript</a>
                    <a href="{url page="login"}" class="editrox-btn editrox-btn-outline">Track Submission</a>
                    <a href="{url page="issue" op="archive"}" class="editrox-btn editrox-btn-ghost">Browse Archive &rarr;</a>
                </div>
            </div>

            <div class="editrox-hero-card">
                <div class="editrox-quick-tracker">
                    <h3>Author &amp; Reviewer Hub</h3>
                    <p>Manage active peer reviews, check real-time manuscript stage status, or upload revised JATS galleys.</p>
                    <ul class="editrox-pipeline-mini">
                        <li><span class="dot active"></span> 1. Intake &amp; Metadata Check</li>
                        <li><span class="dot active"></span> 2. Double-Blind Peer Review</li>
                        <li><span class="dot"></span> 3. JATS XML Typesetting</li>
                        <li><span class="dot"></span> 4. Online-First DOI Publication</li>
                    </ul>
                    <a href="{url page="submissions"}" class="editrox-btn editrox-btn-block">Access Editorial Workflow</a>
                </div>
            </div>
        </div>
    </section>

    <section class="editrox-metrics-strip">
        <div class="editrox-container editrox-metrics-grid">
            <div class="editrox-metric-item">
                <span class="editrox-metric-label">First Decision Speed</span>
                <strong class="editrox-metric-value">{$editroxReviewTime|escape}</strong>
            </div>
            <div class="editrox-metric-item">
                <span class="editrox-metric-label">Acceptance Rate</span>
                <strong class="editrox-metric-value">{$editroxAcceptance|escape}</strong>
            </div>
            <div class="editrox-metric-item">
                <span class="editrox-metric-label">Indexing &amp; Discovery</span>
                <strong class="editrox-metric-value">{$editroxIndexing|escape}</strong>
            </div>
            <div class="editrox-metric-item">
                <span class="editrox-metric-label">Production Engine</span>
                <strong class="editrox-metric-value">Automated JATS XML &amp; DOI</strong>
            </div>
        </div>
    </section>

    <div class="editrox-container editrox-main-layout">
        {if $currentJournal->getLocalizedData('description')}
            <section class="editrox-surface-card">
                <span class="editrox-eyebrow">Journal Overview</span>
                <h2>Scope &amp; Academic Mission</h2>
                <div class="editrox-prose">
                    {$currentJournal->getLocalizedData('description')|strip_unsafe_html}
                </div>
            </section>
        {/if}

        {if $issue}
            <section class="editrox-current-issue">
                <div class="editrox-section-header">
                    <div>
                        <span class="editrox-eyebrow">Current Release</span>
                        <h2>{$issue->getIssueIdentification()|escape}</h2>
                    </div>
                    <a href="{url page="issue" op="archive"}" class="editrox-link-arrow">Explore Full Archive &rarr;</a>
                </div>
                <div class="editrox-toc-wrapper">
                    {include file="frontend/objects/issue_toc.tpl"}
                </div>
            </section>
        {/if}
    </div>
</div>

{include file="frontend/components/footer.tpl"}
