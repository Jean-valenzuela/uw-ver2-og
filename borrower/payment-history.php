<?php require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
portal_start('Payment History', 'payment-history'); ?>
<section class="portal-card"><a class="portal-button" href="../controllers/borrower-history-pdf.php">Download PDF
        history</a><?php portal_history_table(borrower_history($borrowerAccount['user_id'])); ?></section>
<section class="portal-card">
    <h2>Online checkout status</h2>
    <p>A payment is not counted until confirmed. If you left checkout, you may resume it below. For delayed
        confirmation, check status before paying again.</p>
    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $orders = lender_rows('SELECT * FROM paymongo_orders WHERE borrower_id=? ORDER BY created_at DESC', [$borrowerAccount['user_id']]);
            foreach ($orders as $o): ?>
                <tr>
                    <td><?= e(substr($o['order_id'], 0, 12)) ?></td>
                    <td><?= money($o['amount_cents'] / 100) ?></td>
                    <td><?= e($o['mode']) ?></td>
                    <td><?= e(['creating' => 'Starting checkout', 'pending' => 'Awaiting payment confirmation', 'uncertain' => 'Provider confirmation needed', 'review' => 'Received — lender reconciliation needed', 'paid' => 'Paid', 'failed' => 'Checkout failed', 'expired' => 'Checkout expired'][$o['state']] ?? $o['state']) ?><?= !$o['livemode'] ? ' (test)' : '' ?>
                    </td>
                    <td><?php if (in_array($o['state'], ['pending', 'uncertain', 'creating'], true) && $o['checkout_url']): ?><a
                                href="<?= e($o['checkout_url']) ?>">Resume
                                checkout</a><?php endif;
                    if ($o['session_id'] && $o['state'] !== 'paid'): ?>
                            <form method="post" action="../controllers/borrower-payment-status.php"><?php csrf(); ?><input
                                    type="hidden" name="order_id" value="<?= e($o['order_id']) ?>"><button>Check status</button>
                            </form><?php endif; ?>
                    </td>
                </tr><?php endforeach;
            if (!$orders): ?>
                <tr>
                    <td colspan="5">No online checkouts yet.</td>
                </tr><?php endif; ?>
        </tbody>
    </table>
</section><?php portal_end(); ?>