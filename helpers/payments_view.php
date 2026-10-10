<?php
require_once __DIR__ . '/payment_records.php';
if ($isBorrower) {
    require_once __DIR__ . '/../ajax/borrower.php';
    $viewer = borrower_user();
} else {
    $viewer = lender_user();
    $lenderAccount = $viewer;
}
$field = $isBorrower ? 'borrower_id' : 'lender_id';
$agreements = lender_rows("SELECT agreement_id,principal,total_interest,total_due,term_months,monthly_interest_percent,status FROM loan_agreements WHERE $field=? AND status<>'draft' ORDER BY agreement_id DESC", [$viewer['user_id']]);
$payments = lender_rows("SELECT p.payment_id,p.agreement_id,p.amount,p.payment_date,p.reference_note,u.user_fn,u.user_ln,x.principal_amount,x.interest_amount,c.principal_amount carry_amount,c.added_interest,i.due_date carry_due FROM loan_payments p JOIN loan_agreements a ON a.agreement_id=p.agreement_id JOIN users u ON u.user_id=a.borrower_id LEFT JOIN (SELECT payment_id,SUM(principal_amount) principal_amount,SUM(interest_amount) interest_amount FROM lender_payment_allocations GROUP BY payment_id) x ON x.payment_id=p.payment_id LEFT JOIN loan_principal_carries c ON c.payment_id=p.payment_id LEFT JOIN loan_installments i ON i.installment_id=c.to_installment_id WHERE a.$field=? ORDER BY p.payment_date DESC,p.payment_id DESC", [$viewer['user_id']]);
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Payments | Utang Wise</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/lender-live.css">
    <?php if (!$isBorrower)
        uw_role_design_assets('lender', 'payments'); ?>
</head>

<body class="<?= $isBorrower ? '' : 'uw-lender-theme' ?>">
    <?php if (!$isBorrower): ?>
        <div class="admin-layout"><?php require __DIR__ . '/lender_sidebar.php'; ?>
            <div class="main-content"><?php require __DIR__ . '/lender_topbar.php'; endif; ?>
            <main class="live-payment-wrap"><a href="<?= $isBorrower ? 'client-dashboard' : 'dashboard' ?>.php">Back to
                    dashboard</a>
                <h1>Payments</h1>
                <p id="paymentMessage" role="status"></p>
                <?php if (!$isBorrower): ?>
                    <section class="dashboard-card">
                        <h2>Record a received payment</h2>
                        <p>Record funds already received. This form does not transfer money.</p>
                        <form id="paymentForm" class="live-form" method="post" action="../controllers/record-payment.php">
                            <?php csrf(); ?><input type="hidden" name="request_token"
                                value="<?= bin2hex(random_bytes(32)) ?>">
                            <label>Loan<select name="agreement_id" required>
                                    <option value="">Choose an active loan</option>
                                    <?php foreach ($agreements as $a):
                                        if ($a['status'] !== 'active')
                                            continue; ?>
                                        <option value="<?= (int) $a['agreement_id'] ?>">UW-<?= (int) $a['agreement_id'] ?> ·
                                            <?= e(money($a['principal'])) ?> original principal</option><?php endforeach; ?>
                                </select></label>
                            <label>Payment type<select name="mode">
                                    <option value="regular">Regular payment</option>
                                    <option value="interest-only">Interest only; carry unpaid principal</option>
                                </select></label>
                            <label>Payment date<input type="date" name="payment_date" max="<?= date('Y-m-d') ?>"
                                    value="<?= date('Y-m-d') ?>" required></label>
                            <label>Amount received (PHP)<input name="amount" type="number" min="0.01" step="0.01"
                                    required></label>
                            <label>Payment reference / note<input name="reference_note" maxlength="230"></label>
                            <div id="interestOnlyControls" hidden><button class="live-button" type="button"
                                    id="previewCarry">Calculate interest-only payment</button>
                                <div id="carryPreview" class="live-result" aria-live="polite"></div><label><input
                                        type="checkbox" name="confirm_carry" value="yes" disabled> The borrower requested
                                    interest-only payment and agreed to the displayed principal carry and any extra month of
                                    flat interest.</label>
                            </div>
                            <p class="live-note">Regular partial payments are split proportionally between the principal and
                                interest remaining in each installment, starting with the earliest unpaid installment.
                                Interest-only payments pay only that installment's remaining interest and move its unpaid
                                principal to the next installment. At the final installment, another month is added with the
                                usual interest on the original principal. No penalty or interest on the carried amount is
                                added.</p>
                            <p id="paymentError" class="live-error" role="alert"></p><button class="live-button"
                                type="submit">Save received payment</button>
                        </form>
                    </section><?php endif; ?>
                <section class="dashboard-card">
                    <h2>Recorded payments</h2>
                    <p><?= $isBorrower ? 'Payments recorded by your lender. Contact your lender if a payment is missing.' : 'Payments are shown with the principal and interest amounts recorded at entry.' ?>
                    </p>
                    <div class="live-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date / Loan</th>
                                    <th>Borrower</th>
                                    <th>Received</th>
                                    <th>Principal</th>
                                    <th>Interest</th>
                                    <th>Reference / schedule change</th>
                                </tr>
                            </thead>
                            <tbody><?php foreach ($payments as $p): ?>
                                    <tr id="payment-<?= (int) $p['payment_id'] ?>"
                                        class="<?= (int) ($_GET['view_id'] ?? 0) === (int) $p['payment_id'] ? 'live-highlight' : '' ?>">
                                        <td><?= e($p['payment_date']) ?> · UW-<?= (int) $p['agreement_id'] ?></td>
                                        <td><?= e($p['user_fn'] . ' ' . $p['user_ln']) ?></td>
                                        <td><?= e(money($p['amount'])) ?></td>
                                        <td><?= $p['principal_amount'] === null ? 'Not classified' : e(money($p['principal_amount'])) ?>
                                        </td>
                                        <td><?= $p['interest_amount'] === null ? 'Not classified' : e(money($p['interest_amount'])) ?>
                                        </td>
                                        <td><?= e($p['reference_note']) ?><?php if ($p['carry_amount'] !== null): ?><br><?= e(money($p['carry_amount'])) ?>
                                                principal moved to <?= e($p['carry_due']) ?>. Extra-month interest:
                                                <?= e(money($p['added_interest'])) ?>.<?php endif; ?></td>
                                    </tr><?php endforeach; ?><?php if (!$payments): ?>
                                    <tr>
                                        <td colspan="6">No payments recorded yet.</td>
                                    </tr><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                <section class="dashboard-card">
                    <h2>Current repayment schedules</h2>
                    <p>Includes interest-only carry-forwards and approved extensions.</p>
                    <?php foreach ($agreements as $a): ?>
                        <details>
                            <summary>UW-<?= (int) $a['agreement_id'] ?> · <?= e(ucfirst($a['status'])) ?> · Total repayable
                                <?= e(money($a['total_due'])) ?></summary>
                            <div class="live-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Installment</th>
                                            <th>Due</th>
                                            <th>Amount due</th>
                                            <th>Paid</th>
                                            <th>Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (lender_rows('SELECT * FROM loan_installments WHERE agreement_id=? ORDER BY installment_number', [$a['agreement_id']]) as $i): ?>
                                            <tr>
                                                <td><?= (int) $i['installment_number'] ?></td>
                                                <td><?= e($i['due_date']) ?></td>
                                                <td><?= e(money($i['amount_due'])) ?></td>
                                                <td><?= e(money($i['amount_paid'])) ?></td>
                                                <td><?= e(money(max(0, (float) $i['amount_due'] - (float) $i['amount_paid']))) ?>
                                                </td>
                                            </tr><?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </details><?php endforeach; ?><?php if (!$agreements): ?>
                        <p>No released loans yet.</p><?php endif; ?>
                </section>
            </main><?php if (!$isBorrower): ?>
            </div>
        </div><?php endif; ?>
    <?php if (!$isBorrower): ?>
        <script src="../assets/js/lender-notifications.js"></script>
        <script src="../assets/js/payment-entry.js?v=20261010"></script>
    <?php endif; ?><?php if (function_exists('uw_success_assets'))
          uw_success_assets(); ?>
</body>

</html>