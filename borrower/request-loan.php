<?php require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
portal_start('Request a loan', 'request-loan'); ?>
<section class="portal-card"><?php if (!borrower_can_request($borrowerAccount['user_id'])): ?>
        <p>You can request another loan after your current loan is fully paid and any existing request has been reviewed.
        </p><a href="my-loans.php">View your loans</a><?php else: ?>
        <form class="portal-form" method="post" action="../controllers/borrower-request.php">
            <?php csrf(); ?><label>Requested amount (PHP)<input type="number" name="amount" min="1" max="1000000"
                    step="0.01" required></label><label>Repayment term<select name="term_months">
                    <option value="3">3 months</option>
                    <option value="6">6 months</option>
                    <option value="12">12 months</option>
                </select></label><label>Reason for borrowing<textarea name="purpose" maxlength="1000"
                    required></textarea></label>
            <p>Your lender reviews the request and sets the final interest rate and agreement terms.</p><button>Submit loan
                request</button>
        </form><?php endif; ?>
</section>
<section class="portal-card">
    <h2>Your requests</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Term</th>
                <th>Status</th>
                <th>Decision</th>
            </tr>
        </thead>
        <tbody>
            <?php $requests = lender_rows('SELECT * FROM borrower_loan_requests WHERE borrower_id=? ORDER BY request_id DESC', [$borrowerAccount['user_id']]);
            foreach ($requests as $r): ?>
                <tr>
                    <td>REQ-<?= $r['request_id'] ?></td>
                    <td><?= money($r['amount']) ?></td>
                    <td><?= $r['term_months'] ?> months</td>
                    <td><?= e(ucfirst($r['status'])) ?></td>
                    <td><?= e($r['reason'] ?? 'Awaiting review') ?></td>
                </tr><?php endforeach;
            if (!$requests): ?>
                <tr>
                    <td colspan="5">No requests yet.</td>
                </tr><?php endif; ?>
        </tbody>
    </table>
</section><?php portal_end(); ?>