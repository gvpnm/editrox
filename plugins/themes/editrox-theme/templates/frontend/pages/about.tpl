{include file="frontend/components/header.tpl" pageTitle="about.aboutContext"}

<div class="editrox-wrapper preset-{$editroxPreset|escape}">
    <div class="editrox-page-banner">
        <div class="editrox-container">
            <span class="editrox-eyebrow">Governance &amp; Policies</span>
            <h1>About {$currentJournal->getLocalizedName()|escape}</h1>
        </div>
    </div>

    <div class="editrox-container editrox-two-col-layout">
        <aside class="editrox-sidebar-cards">
            <div class="editrox-info-box">
                <h4>Quick Journal Facts</h4>
                <dl class="editrox-meta-list">
                    {if $currentJournal->getData('onlineIssn')}
                        <dt>e-ISSN</dt><dd>{$currentJournal->getData('onlineIssn')|escape}</dd>
                    {/if}
                    <dt>Review Model</dt><dd>Double-Blind Peer Review</dd>
                    <dt>First Decision</dt><dd>{$editroxReviewTime|escape}</dd>
                    <dt>Access Policy</dt><dd>{$editroxAccessModel|escape}</dd>
                    <dt>Indexing</dt><dd>{$editroxIndexing|escape}</dd>
                </dl>
                <a href="{url page="about" op="editorialTeam"}" class="editrox-btn editrox-btn-outline-dark editrox-btn-block">View Editorial Board</a>
            </div>
        </aside>

        <main class="editrox-content-column">
            <div class="editrox-surface-card">
                {include file="frontend/components/editLink.tpl" page="management" op="settings" path="context" anchor="masthead" sectionTitleKey="about.aboutContext"}
                <div class="editrox-prose">
                    {$currentContext->getLocalizedData('about')|strip_unsafe_html}
                </div>
            </div>

            <div class="editrox-policy-grid">
                <div class="editrox-policy-card">
                    <h3>Open Access &amp; Licensing</h3>
                    <p>Articles are published under Creative Commons licensing, permitting immediate worldwide barrier-free reading and citation.</p>
                </div>
                <div class="editrox-policy-card">
                    <h3>Publication Ethics</h3>
                    <p>We adhere strictly to COPE (Committee on Publication Ethics) guidelines regarding originality, authorship, and conflict-of-interest disclosure.</p>
                </div>
            </div>
        </main>
    </div>
</div>

{include file="frontend/components/footer.tpl"}
