{include file="frontend/components/header.tpl" pageTitle="user.login"}

<div class="editrox-wrapper preset-{$editroxPreset|escape}">
    <div class="editrox-container editrox-auth-container">
        <div class="editrox-auth-card">
            <div class="editrox-auth-info">
                <span class="editrox-badge editrox-badge-accent">Editorial &amp; Author Portal</span>
                <h2>{$currentJournal->getLocalizedName()|escape}</h2>
                <p>Sign in to access your real-time manuscript tracker, submit revisions, or complete peer review assignments.</p>
                <ul class="editrox-auth-features">
                    <li>&#10003; Live 4-stage submission status tracking</li>
                    <li>&#10003; One-click DOCX to JATS XML proofing</li>
                    <li>&#10003; Automated World Bank APC waiver calculation</li>
                </ul>
            </div>

            <div class="editrox-auth-form-wrap">
                <h1>{translate key="user.login"}</h1>

                {if $loginMessage}
                    <div class="pkp_notification">{translate key=$loginMessage}</div>
                {/if}

                <form class="editrox-form" id="login" method="post" action="{$loginUrl}">
                    {csrf}
                    {if $error}
                        <div class="editrox-alert-error">
                            {translate key=$error reason=$reason}
                        </div>
                    {/if}
                    <input type="hidden" name="source" value="{$source|strip_unsafe_html|escape}" />

                    <div class="editrox-field">
                        <label for="username">{translate key="user.username"}</label>
                        <input type="text" name="username" id="username" value="{$username|escape}" maxlength="32" required>
                    </div>

                    <div class="editrox-field">
                        <div class="editrox-label-row">
                            <label for="password">{translate key="user.password"}</label>
                            <a href="{url page="login" op="lostPassword"}" class="forgot-link">{translate key="user.login.forgotPassword"}</a>
                        </div>
                        <input type="password" name="password" id="password" value="{$password|escape}" maxlength="32" required>
                    </div>

                    {if $remember}
                        <div class="editrox-checkbox">
                            <input type="checkbox" name="remember" id="remember" value="1" checked="$remember">
                            <label for="remember">{translate key="user.login.rememberUsernameAndPassword"}</label>
                        </div>
                    {/if}

                    <div class="editrox-form-actions">
                        <button class="editrox-btn editrox-btn-primary editrox-btn-block" type="submit">
                            {translate key="user.login"}
                        </button>
                    </div>

                    {if !$disableUserReg}
                        <div class="editrox-register-prompt">
                            <span>New to the journal?</span>
                            <a href="{url page="user" op="register" source=$source}">{translate key="user.login.registerNewAccount"}</a>
                        </div>
                    {/if}
                </form>
            </div>
        </div>
    </div>
</div>

{include file="frontend/components/footer.tpl"}
