<?php
require __DIR__ . '/../helpers/lender_dashboard.php';
$lenderAccount = lender_user();
$year = (int) ($_GET['year'] ?? date('Y'));
if ($year < 2000 || $year > 2100)
    $year = (int) date('Y');
$d = lender_dashboard_data($lenderAccount['user_id'], $year);
function dash_money($c)
{
    return 'PHP ' . number_format($c / 100, 2);
}
$max = max(1, ...array_column($d['months'], 'lent'), ...array_column($d['months'], 'paid'));
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lender Dashboard | Utang Wise</title>
    <link rel="stylesheet" href="../assets/css/client-dashboard.css">
    <link rel="stylesheet" href="../assets/css/lender-live.css">
</head>

<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="brand"><img src="../assets/logo/utangwiselogo.png" width="42" alt="Utang Wise">
                <div class="brand-text">
                    <h2>UTANG WISE</h2><span>LENDING MADE SIMPLE</span>
                </div>
            </div>
            <nav class="sidebar-menu">
                <?php foreach (['dashboard' => 'Dashboard', 'applications' => 'Applications', 'loaners' => 'Loaners', 'loans' => 'Loans', 'payments' => 'Payments', 'extension-requests' => 'Extension Requests', 'profile-photo' => 'Profile Photo'] as $path => $label): ?><a
                        class="menu-item <?= $path === 'dashboard' ? 'active' : '' ?>"
                        href="<?= e($path) ?>.php"><?= e($label) ?></a><?php endforeach; ?></nav>
            <form method="post" action="../ajax/logout.php"><?php csrf(); ?><button class="menu-item live-logout">Log
                    out</button></form>
        </aside>
        <main class="main-content"><?php require __DIR__ . '/../helpers/lender_topbar.php'; ?>
            <div class="live-body">
                <h1>Lender Dashboard</h1>
                <p>Your lending activity, balances and upcoming payments.</p>
                <section class="live-stats">
                    <?php foreach (['lent' => 'Total Amount Lent', 'paid' => 'Total Paid', 'overdue' => 'Total Overdue', 'interest' => 'Interest Collection', 'loaners' => 'Total Loaners'] as $key => $label): ?>
                        <article class="dashboard-card"><span><?= e($label) ?></span><strong
                                data-metric="<?= e($key) ?>"><?= $key === 'loaners' ? (int) $d['totals'][$key] : e(dash_money($d['totals'][$key])) ?></strong><small><?= ['lent' => 'Released principal, excluding draft loans', 'paid' => 'Payments applied to installments', 'overdue' => 'Unpaid installments before today', 'interest' => 'Interest portion of recorded payments', 'loaners' => 'Approved borrower accounts'][$key] ?></small>
                        </article><?php endforeach; ?>
                </section>
                <?php if ($d['totals']['legacy_interest']): ?>
                    <p class="live-note">Interest collection includes <?= e(dash_money($d['totals']['legacy_interest'])) ?>
                        estimated proportionally for historical payments without a saved principal/interest breakdown. New
                        payments save their allocation.</p><?php endif; ?>
                <?php if ($d['unclassifiedInterestPayments']): ?>
                    <p class="live-note">Interest has not been classified for
                        <?= e(dash_money($d['unclassifiedInterestPayments'])) ?> of payments on historical schedules that
                        need review. Those payments are included in Total Paid but excluded from Interest Collection.</p>
                <?php endif; ?>
                <div class="live-grid">
                    <section class="dashboard-card">
                        <div class="live-heading">
                            <h2>Summary of Borrowers</h2><a href="loaners.php">View all</a>
                        </div>
                        <div class="live-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Borrower / Loan</th>
                                        <th>Next due</th>
                                        <th>Status</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody><?php foreach (array_slice($d['summary'], 0, 8) as $a): ?>
                                        <tr>
                                            <td><a href="loans.php?view_id=<?= (int) $a['agreement_id'] ?>"><?= e($a['user_fn'] . ' ' . $a['user_ln']) ?>
                                                    · UW-<?= (int) $a['agreement_id'] ?></a></td>
                                            <td><?= e($a['next_due_date'] ?? 'Paid') ?></td>
                                            <td><?= e($a['display_status']) ?></td>
                                            <td><?= e(money($a['balance'])) ?></td>
                                        </tr><?php endforeach; ?><?php if (!$d['summary']): ?>
                                        <tr>
                                            <td colspan="4">No released loans yet.</td>
                                        </tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="dashboard-card">
                        <h2>Reminders</h2>
                        <div class="live-reminders">
                            <?php foreach ([[(int) $d['overdue']['borrowers'], 'borrowers have overdue payments', 'loans.php'], [$d['dueSoon'], 'borrowers have payments due within 7 days', 'loans.php'], [$d['pending'], 'applications await review', 'applications.php'], [$d['extensions'], 'extension requests await review', 'extension-requests.php']] as [$count, $label, $url]): ?><a
                                    href="<?= e($url) ?>"><strong><?= $count ?></strong> <?= e($label) ?>
                                    →</a><?php endforeach; ?></div>
                    </section>
                    <section class="dashboard-card live-wide">
                        <div class="live-heading">
                            <h2>Monthly Lending vs Payments</h2>
                            <form method="get"><label>Year <input name="year" type="number" min="2000" max="2100"
                                        value="<?= $year ?>"></label><button>View</button></form><a class="live-button"
                                href="../controllers/lender-report.php?year=<?= $year ?>">Download CSV report</a>
                        </div>
                        <p class="live-legend"><span>■ Amount lent</span> <span>■ Payments received</span></p>
                        <div class="live-chart"
                            aria-label="Monthly lending and payments; exact amounts in the table below">
                            <?php foreach ($d['months'] as $m): ?>
                                <div class="live-month">
                                    <div class="live-bars">
                                        <div class="live-bar lent" style="height:<?= round($m['lent'] / $max * 100, 2) ?>%"
                                            title="<?= e($m['month'] . ' lent: ' . dash_money($m['lent'])) ?>"></div>
                                        <div class="live-bar paid" style="height:<?= round($m['paid'] / $max * 100, 2) ?>%"
                                            title="<?= e($m['month'] . ' paid: ' . dash_money($m['paid'])) ?>"></div>
                                    </div><span><?= e($m['month']) ?></span>
                                </div><?php endforeach; ?>
                        </div>
                        <details>
                            <summary>View monthly amounts</summary>
                            <div class="live-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Amount lent</th>
                                            <th>Payments</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php foreach ($d['months'] as $m): ?>
                                            <tr>
                                                <td><?= e($m['month'] . ' ' . $year) ?></td>
                                                <td><?= e(dash_money($m['lent'])) ?></td>
                                                <td><?= e(dash_money($m['paid'])) ?></td>
                                            </tr><?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </details>
                        <p class="live-note">Report uses recorded release dates and payment dates.
                            <?= e(dash_money($d['undatedLent'])) ?> of historical principal has no release date. The
                            difference between installment payments and dated payment records is
                            <?= e(dash_money($d['totals']['paid'] - $d['recorded'])) ?>; undated amounts are not assigned
                            to a month.</p>
                    </section>
                    <section class="dashboard-card live-wide">
                        <div class="live-heading">
                            <h2>Upcoming Payment Schedule</h2><a href="payments.php">Record a payment</a>
                        </div>
                        <p>Next 12 unpaid installments from today, including approved schedule changes.</p>
                        <div class="live-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Due date</th>
                                        <th>Borrower</th>
                                        <th>Loan</th>
                                        <th>Installment</th>
                                        <th>Remaining due</th>
                                    </tr>
                                </thead>
                                <tbody><?php foreach ($d['upcoming'] as $i): ?>
                                        <tr>
                                            <td><?= e($i['due_date']) ?></td>
                                            <td><?= e($i['user_fn'] . ' ' . $i['user_ln']) ?></td>
                                            <td>UW-<?= (int) $i['agreement_id'] ?></td>
                                            <td><?= (int) $i['installment_number'] ?></td>
                                            <td><?= e(money($i['balance'])) ?></td>
                                        </tr><?php endforeach; ?><?php if (!$d['upcoming']): ?>
                                        <tr>
                                            <td colspan="5">No upcoming unpaid installments.</td>
                                        </tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/js/lender-notifications.js"></script>
<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>

</html>