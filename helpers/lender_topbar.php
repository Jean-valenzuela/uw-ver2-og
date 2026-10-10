<?php
$lenderTabLabels = [
    'dashboard' => 'Dashboard',
    'applications' => 'Applications',
    'loaners' => 'Loaners',
    'loans' => 'Loans',
    'payments' => 'Payments',
    'extension-requests' => 'Extension Requests',
];
$lenderTab = basename($_SERVER['SCRIPT_NAME'] ?? '', '.php');
$lenderTabTitle = $lenderTabLabels[$lenderTab] ?? 'Lender workspace';
$lenderInitials = strtoupper(substr($lenderAccount['user_fn'] ?? 'L', 0, 1) . substr($lenderAccount['user_ln'] ?? '', 0, 1));
?>
<header class="uw-live-topbar">
    <div class="uw-live-page-title">
        <small>Lender workspace</small>
        <strong><?= e($lenderTabTitle) ?></strong>
    </div>
    <div class="uw-live-actions">
        <div class="uw-live-notifications">
            <button type="button" id="lenderNotificationToggle" aria-label="Notifications" title="Notifications" aria-expanded="false">
                <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
                <span id="lenderNotificationCount" hidden>0</span>
            </button>
            <div id="lenderNotificationPanel" hidden>
                <h3>New activity</h3>
                <button type="button" id="lenderMarkAllRead">Mark all as read</button>
                <div id="lenderNotificationItems"></div>
                <p id="lenderNotificationError" role="status"></p>
            </div>
        </div>
        <div class="uw-live-user">
            <span class="uw-live-avatar" aria-hidden="true"><?= e($lenderInitials) ?></span>
            <span><strong><?= e(($lenderAccount['user_fn'] ?? '') . ' ' . ($lenderAccount['user_ln'] ?? '')) ?></strong><small>Lender</small></span>
        </div>
    </div>
</header>
<script type="application/json" id="lenderNotificationConfig"><?= json_encode(['csrf' => $_SESSION['csrf']], JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
