{include file="frontend/components/header.tpl" pageTitle="about.submissions"}

<div class="editrox-wrapper preset-{$editroxPreset|escape}">
    <div class="editrox-page-banner">
        <div class="editrox-container">
            <span class="editrox-eyebrow">Author Portal &amp; Manuscript Tracking</span>
            <h1>{translate key="about.submissions"}</h1>
        </div>
    </div>

    <div class="editrox-container editrox-main-layout">
        {* VISUAL 4-STAGE ARTICLE TRACKING PIPELINE *}
        <section class="editrox-tracker-banner">
            <div class="editrox-tracker-header">
                <div>
                    <h2>Real-Time Manuscript Lifecycle &amp; Tracking</h2>
                    <p>Track your manuscript through every stage of our automated editorial and JATS XML production pipeline.</p>
                </div>
                <div class="editrox-tracker-cta">
                    {if $isUserLoggedIn}
                        <a href="{url page="submission" op="wizard"}" class="editrox-btn editrox-btn-primary">New Manuscript Submission</a>
                        <a href="{url page="submissions"}" class="editrox-btn editrox-btn-outline-dark">Open Author Dashboard</a>
                    {else}
                        <a href="{url page="login"}" class="editrox-btn editrox-btn-primary">Login to Track Article</a>
                        <a href="{url page="user" op="register"}" class="editrox-btn editrox-btn-outline-dark">Register Author Account</a>
                    {/if}
                </div>
            </div>

            <div class="editrox-stepper-grid">
                <div class="editrox-step-card">
                    <span class="step-num">Stage 01</span>
                    <h4>Initial Screening &amp; Intake</h4>
                    <p>Automated metadata validation, scope screening, and World Bank APC tier verification.</p>
                </div>
                <div class="editrox-step-card">
                    <span class="step-num">Stage 02</span>
                    <h4>Double-Blind Peer Review</h4>
                    <p>OpenAlex semantic reviewer matching with automated conflict-of-interest checks (Avg: {$editroxReviewTime|escape}).</p>
                </div>
                <div class="editrox-step-card">
                    <span class="step-num">Stage 03</span>
                    <h4>Copyediting &amp; JATS XML</h4>
                    <p>Automated DOCX-to-JATS XML conversion and author galley proofing.</p>
                </div>
                <div class="editrox-step-card">
                    <span class="step-num">Stage 04</span>
                    <h4>Online-First &amp; DOI Deposit</h4>
                    <p>Immediate early-access publication, Crossref DOI registration, and live citation tracking.</p>
                </div>
            </div>
        </section>

        {if $submissionChecklist}
            <section class="editrox-surface-card">
                <h2>{translate key="about.submissionPreparationChecklist"}</h2>
                <p>{translate key="about.submissionPreparationChecklist.description"}</p>
                <ul class="editrox-checklist">
                    {foreach from=$submissionChecklist item=checklistItem}
                        <li>
                            <span class="check-icon">&#10003;</span>
                            <div class="check-text">{$checklistItem.content|nl2br}</div>
                        </li>
                    {/foreach}
                </ul>
            </section>
        {/if}

        {if $currentContext->getLocalizedData('authorGuidelines')}
            <section class="editrox-surface-card">
                <h2>{translate key="about.authorGuidelines"}</h2>
                <div class="editrox-prose">
                    {$currentContext->getLocalizedData('authorGuidelines')|strip_unsafe_html}
                </div>
            </section>
        {/if}

        {if $currentContext->getLocalizedData('copyrightNotice')}
            <section class="editrox-surface-card">
                <h2>{translate key="about.copyrightNotice"}</h2>
                <div class="editrox-prose">
                    {$currentContext->getLocalizedData('copyrightNotice')|strip_unsafe_html}
                </div>
            </section>
        {/if}
    </div>
</div>

{include file="frontend/components/footer.tpl"}
