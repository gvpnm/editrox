{capture assign="pageTitle"}
    {if $prevPage}
        {translate key="archive.archivesPageNumber" pageNumber=$pageNumber}
    {else}
        {translate key="archive.archives"}
    {/if}
{/capture}
{include file="frontend/components/header.tpl" pageTitleTranslated=$pageTitle}

<div class="editrox-wrapper preset-{$editroxPreset|escape}">
    <div class="editrox-page-banner">
        <div class="editrox-container">
            <span class="editrox-eyebrow">Published Volumes &amp; Issues</span>
            <h1>{$pageTitle|escape}</h1>
        </div>
    </div>

    <div class="editrox-container editrox-main-layout">
        {if empty($issues)}
            <div class="editrox-surface-card">
                <p>{translate key="current.noCurrentIssueDesc"}</p>
            </div>
        {else}
            <div class="editrox-archive-grid">
                {foreach from=$issues item="issue"}
                    <article class="editrox-issue-grid-card">
                        {if $issue->getLocalizedCoverImageUrl()}
                            <a href="{url op="view" path=$issue->getBestIssueId()}" class="editrox-issue-cover">
                                <img src="{$issue->getLocalizedCoverImageUrl()|escape}" alt="{$issue->getLocalizedCoverImageAltText()|escape|default:''}">
                            </a>
                        {else}
                            <a href="{url op="view" path=$issue->getBestIssueId()}" class="editrox-issue-cover-placeholder">
                                <span class="vol-badge">{$issue->getIssueSeries()|escape}</span>
                                <strong>{$currentJournal->getLocalizedAcronym()|escape}</strong>
                            </a>
                        {/if}

                        <div class="editrox-issue-card-body">
                            {if $issue->getDatePublished()}
                                <span class="editrox-issue-date">{$issue->getDatePublished()|date_format:"%B %Y"}</span>
                            {/if}
                            <h3>
                                <a href="{url op="view" path=$issue->getBestIssueId()}">
                                    {$issue->getIssueIdentification()|escape}
                                </a>
                            </h3>
                            <div class="editrox-issue-desc">
                                {$issue->getLocalizedDescription()|strip_unsafe_html|truncate:140}
                            </div>
                            <a href="{url op="view" path=$issue->getBestIssueId()}" class="editrox-link-arrow">Read Issue &rarr;</a>
                        </div>
                    </article>
                {/foreach}
            </div>

            {if $prevPage > 1}
                {capture assign=prevUrl}{url router=$smarty.const.ROUTE_PAGE page="issue" op="archive" path=$prevPage}{/capture}
            {elseif $prevPage === 1}
                {capture assign=prevUrl}{url router=$smarty.const.ROUTE_PAGE page="issue" op="archive"}{/capture}
            {/if}
            {if $nextPage}
                {capture assign=nextUrl}{url router=$smarty.const.ROUTE_PAGE page="issue" op="archive" path=$nextPage}{/capture}
            {/if}
            {include file="frontend/components/pagination.tpl" prevUrl=$prevUrl nextUrl=$nextUrl showingStart=$showingStart showingEnd=$showingEnd total=$total}
        {/if}
    </div>
</div>

{include file="frontend/components/footer.tpl"}
