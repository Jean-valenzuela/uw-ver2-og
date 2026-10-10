<?php require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
$loans = borrower_loans($borrowerAccount['user_id']);
$dues = borrower_dues($borrowerAccount['user_id']);
$next = $dues[0] ?? null;
$a = null;
foreach ($loans as $l)
    if (in_array($l['status'], ['active', 'draft'], true)) {
        $a = $l;
        break;
    }
portal_start('Your loan overview', 'client-dashboard'); ?>
<div class="top-cards">
    <section class="current-loan-card">
        <div class="card-heading">
            <h2>Current Loan</h2><span class="status ongoing"><?= $a ? e(loan_status($a)) : 'No current loan' ?></span>
        </div>
        <div class="loan-main">
            <div class="loan-amount-area">
                <div class="money-row">
                    <div>
                        <h3><?= money($a['principal'] ?? 0) ?></h3>
                        <p>Loan amount</p>
                    </div>
                </div>
                <div class="loan-details">
                    <div><strong><?= $a ? e($a['monthly_interest_percent']) . '%' : '—' ?></strong><span>Flat monthly
                            interest</span></div>
                    <div><strong><?= $a ? (int) $a['term_months'] . ' months' : '—' ?></strong><span>Original repayment
                            term</span></div>
                    <div>
                        <strong><?= money($next['balance'] ?? $a['monthly_payment'] ?? 0) ?></strong><span><?= $next ? 'Next installment balance' : 'Monthly installment' ?></span>
                    </div>
                </div>
            </div>
            <div class="due-area">
                <div class="due-circle"><span>Next
                        Due</span><strong><?= $next ? e($next['due_date']) : 'No payment due' ?></strong><small><?= $next ? e(due_label($next['due_date'])) : '' ?></small>
                </div><a class="pay-now-button" href="payments.php">View payments</a>
            </div>
        </div>
    </section>
    <section class="upcoming-card">
        <h2>Upcoming Payment</h2>
        <h3 class="upcoming-amount"><?= money($next['balance'] ?? 0) ?></h3>
        <p class="due-date"><?= $next ? 'Due on ' . e($next['due_date']) : 'No released loan with unpaid installments.' ?></p>
        <div class="payment-alert"><?= $next ? e(due_label($next['due_date'])) : 'You are up to date.' ?></div>
    </section>
</div>
<div class="table-grid">
    <section class="table-card">
        <h2>Pending Dues</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Due ID</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody><?php foreach ($dues as $i): ?>
                        <tr>
                            <td>DUE-<?= (int) $i['installment_id'] ?></td>
                            <td><?= e($i['due_date']) ?></td>
                            <td><?= money($i['balance']) ?></td>
                            <td><?= e(due_status($i['due_date'])) ?></td>
                        </tr><?php endforeach;
                if (!$dues): ?>
                        <tr>
                            <td colspan="4">No pending dues.</td>
                        </tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="table-card">
        <h2>Payment History</h2>
        <?php portal_history_table(array_slice(borrower_history($borrowerAccount['user_id']), 0, 8)); ?><a
            href="payment-history.php">View all payments</a>
    </section>
</div><?php portal_end(); ?>