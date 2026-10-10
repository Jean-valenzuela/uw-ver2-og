<?php

require_once __DIR__ . '/../ajax/borrower.php';
require_once __DIR__ . '/payment_records.php';

function borrower_loans($id)
{
    return lender_rows(
        "SELECT a.*, c.released_at, c.signed_pdf IS NOT NULL AS has_signed,
                c.purpose,
                COALESCE((SELECT SUM(amount_paid) FROM loan_installments WHERE agreement_id = a.agreement_id), 0) AS paid,
                (SELECT MAX(due_date) FROM loan_installments WHERE agreement_id = a.agreement_id) AS last_due,
                EXISTS(
                    SELECT 1 FROM loan_installments
                    WHERE agreement_id = a.agreement_id
                      AND amount_due > amount_paid
                      AND due_date < CURDATE()
                ) AS overdue
         FROM loan_agreements a
         LEFT JOIN lender_contracts c ON c.agreement_id = a.agreement_id
         WHERE a.borrower_id = ?
         ORDER BY a.agreement_id DESC",
        [$id]
    );
}

function borrower_dues($id)
{
    return lender_rows(
        "SELECT i.*, i.amount_due - i.amount_paid AS balance
         FROM loan_installments i
         JOIN loan_agreements a ON a.agreement_id = i.agreement_id
         WHERE a.borrower_id = ?
           AND a.status = 'active'
           AND i.amount_due > i.amount_paid
         ORDER BY i.due_date, i.installment_id",
        [$id]
    );
}

function borrower_history($id)
{
    return lender_rows(
        "SELECT p.*, COALESCE(o.method, 'Recorded by lender') AS method,
                'Paid' AS payment_status
         FROM loan_payments p
         JOIN loan_agreements a ON a.agreement_id = p.agreement_id
         LEFT JOIN paymongo_orders o ON o.payment_id = p.payment_id
         WHERE a.borrower_id = ?
         ORDER BY p.payment_date DESC, p.payment_id DESC",
        [$id]
    );
}

function borrower_can_request($id)
{
    $hasLoan = db(
        "SELECT a.agreement_id
         FROM loan_agreements a
         WHERE a.borrower_id = ?
           AND (
               a.status IN ('draft', 'active')
               OR EXISTS (
                   SELECT 1 FROM loan_installments i
                   WHERE i.agreement_id = a.agreement_id
                     AND i.amount_due > i.amount_paid
               )
           )
         LIMIT 1",
        [$id]
    )->get_result()->num_rows > 0;

    $hasPendingRequest = db(
        "SELECT request_id
         FROM borrower_loan_requests
         WHERE borrower_id = ? AND status = 'pending'",
        [$id]
    )->get_result()->num_rows > 0;

    return !$hasLoan && !$hasPendingRequest;
}

function due_label($date)
{
    $days = (int) (new DateTimeImmutable('today'))
        ->diff(new DateTimeImmutable($date))
        ->format('%r%a');

    if ($days < 0) {
        return abs($days) . ' days overdue';
    }

    return $days === 0 ? 'Due today' : $days . ' days left';
}

function due_status($date)
{
    if ($date < date('Y-m-d')) {
        return 'Overdue';
    }

    return $date <= date('Y-m-d', strtotime('+7 days')) ? 'Due soon' : 'Upcoming';
}

function loan_status($loan)
{
    if ($loan['status'] === 'draft') {
        return 'Awaiting release';
    }

    if ($loan['status'] === 'active' && $loan['overdue']) {
        return 'Overdue';
    }

    return ucfirst($loan['status']);
}

function borrower_notices($id)
{
    $read = array_column(
        lender_rows(
            'SELECT event_key FROM borrower_notification_reads WHERE borrower_id = ?',
            [$id]
        ),
        'event_key'
    );

    $items = [];
    $today = date('Y-m-d');
    $reminderLimit = date('Y-m-d', strtotime('+7 days'));

    foreach (borrower_dues($id) as $installment) {
        if ($installment['due_date'] > $reminderLimit) {
            continue;
        }

        $type = $installment['due_date'] < $today ? 'overdue' : 'reminder';
        $key = $installment['installment_id'] . '-' . $installment['due_date'] . '-' . $type;

        if (in_array($key, $read, true)) {
            continue;
        }

        $items[] = [
            'key' => $key,
            'text' => due_status($installment['due_date']) . ': '
                . money($installment['balance']) . ' for DUE-'
                . $installment['installment_id'] . ' on '
                . $installment['due_date'] . '. '
                . due_label($installment['due_date']) . '.',
        ];
    }

    return $items;
}

function portal_start($title, $active)
{
    global $borrowerAccount;

    $user = $borrowerAccount;
    $routes = [
        'client-dashboard',
        'my-loans',
        'request-loan',
        'payments',
        'payment-extension',
        'payment-history',
        'signed-agreement',
        'profile',
    ];
    $design = in_array($active, $routes, true) ? $active : 'profile';
    $isDashboard = $design === 'client-dashboard';
    $items = borrower_notices($user['user_id']);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= e($title) ?> | Utang Wise</title>
        <link rel="stylesheet" href="../assets/css/integ-borrower/<?= e($design) ?>.css">
        <link rel="stylesheet" href="../assets/css/borrower-flow.css">
        <link rel="stylesheet" href="../assets/css/borrower-portal.css">
        <link rel="stylesheet" href="../assets/css/portal-integration.css">
        <link rel="stylesheet" href="<?= e(base_url()) ?>/assets/css/local-fonts.css">
    </head>
    <body class="uw-borrower-portal">
        <div class="<?= $isDashboard ? 'dashboard-layout' : 'client-layout' ?>">
            <aside class="sidebar" id="sidebar">
                <div class="brand">
                    <div class="brand-icon">
                        <img src="../assets/logo/utangwiselogo.png" alt="Utang Wise">
                    </div>
                    <div class="brand-text">
                        <h2>UTANG WISE</h2>
                        <span>LENDING MADE SIMPLE</span>
                    </div>
                </div>

                <nav class="sidebar-menu">
                    <?php
                    $menu = [
                        'client-dashboard' => ['home', 'Dashboard'],
                        'profile' => ['person', 'Profile'],
                        'my-loans' => ['description', 'My Loans'],
                        'request-loan' => ['add_circle', 'Request Loan'],
                        'payments' => ['credit_card', 'Payments'],
                        'payment-extension' => ['calendar_month', 'Payment Extension'],
                        'payment-history' => ['history', 'Payment History'],
                        'signed-agreement' => ['draw', 'Agreements'],
                    ];

                    foreach ($menu as $route => [$icon, $label]):
                        ?>
                        <a class="menu-item <?= $route === $active ? 'active' : '' ?>"
                           href="<?= e($route) ?>.php">
                            <span class="material-symbols-outlined" aria-hidden="true"><?= e($icon) ?></span>
                            <span><?= e($label) ?></span>
                        </a>
                    <?php endforeach; ?>
                </nav>

                <div class="sidebar-divider"></div>
                <?php borrower_logout_button(); ?>
            </aside>

            <button type="button" class="sidebar-overlay" id="portalOverlay"
                    aria-label="Close navigation" hidden></button>

            <main class="<?= $isDashboard ? 'main-area' : 'main-content' ?>">
                <header class="topbar">
                    <div class="topbar-left">
                        <button type="button" class="mobile-menu-btn" id="portalMenu"
                                aria-label="Toggle menu" aria-controls="sidebar" aria-expanded="false">
                            <span class="material-symbols-outlined" aria-hidden="true">menu</span>
                        </button>
                        <div class="topbar-page-title">
                            <span>Welcome back!</span>
                            <h2><?= e($title) ?></h2>
                        </div>
                    </div>

                    <div class="top-user user-area">
                        <details class="portal-notifications">
                            <summary aria-label="Notifications" title="Notifications">
                                <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
                                <?php if ($items): ?>
                                    <span class="portal-notification-count"><?= count($items) ?></span>
                                <?php endif; ?>
                            </summary>
                            <div>
                                <h3>Notifications</h3>
                                <?php if (!$items): ?>
                                    <p>No unread reminders.</p>
                                <?php endif; ?>
                                <?php foreach ($items as $item): ?>
                                    <form method="post" action="../controllers/borrower-notifications.php">
                                        <?php csrf(); ?>
                                        <input type="hidden" name="event_key" value="<?= e($item['key']) ?>">
                                        <p><?= e($item['text']) ?></p>
                                        <button class="portal-button" type="submit">Mark as read</button>
                                    </form>
                                <?php endforeach; ?>
                                <a href="payments.php">View payments</a>
                            </div>
                        </details>

                        <div class="topbar-profile-name">
                            <strong><?= e(trim($user['user_fn'] . ' ' . $user['user_ln'])) ?></strong>
                        </div>
                    </div>
                </header>

                <div class="<?= $isDashboard ? 'dashboard-body' : 'page-content' ?>">
                    <section class="dashboard-content">
                        <div class="page-heading welcome-section">
                            <h1><?= e($title) ?></h1>
                        </div>
                        <?php notice(); ?>
    <?php
}

function portal_end()
{
    ?>
                    </section>
                </div>
            </main>
        </div>
        <script src="../assets/js/borrower-portal.js" defer></script>
        <?php uw_success_assets(); ?>
    </body>
    </html>
    <?php
}

function portal_history_table($rows)
{
    ?>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>PAY-<?= (int) $row['payment_id'] ?></td>
                        <td><?= e($row['payment_date']) ?></td>
                        <td><?= money($row['amount']) ?></td>
                        <td><?= e($row['method']) ?></td>
                        <td><?= e($row['payment_status']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$rows): ?>
                    <tr><td colspan="5">No payments recorded yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
