<?php require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
$loans = borrower_loans($borrowerAccount['user_id']);
$counts = ['Total loans' => count($loans), 'Active loans' => 0, 'Completed loans' => 0, 'Overdue loans' => 0];
$principal = 0;
$paid = 0;
$balance = 0;
foreach ($loans as $a) {
    if ($a['status'] === 'active') {
        $counts['Active loans']++;
        if ($a['overdue'])
            $counts['Overdue loans']++;
    }
    if ($a['status'] === 'completed')
        $counts['Completed loans']++;
    if ($a['status'] !== 'draft') {
        $principal += $a['principal'];
        $paid += $a['paid'];
        $balance += max(0, $a['total_due'] - $a['paid']);
    }
}
portal_start('My Loans', 'my-loans'); ?>
<div class="portal-grid"><?php foreach ($counts as $k => $v): ?>
        <section class="portal-card portal-summary"><?= e($k) ?><strong><?= $v ?></strong></section><?php endforeach; ?>
</div>
<section class="portal-card"><label>Search loans <input data-filter-table="#borrowerLoans" type="search"></label>
    <div class="table-wrapper">
        <table id="borrowerLoans">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Loan amount</th>
                    <th>Date granted</th>
                    <th>Final due date</th>
                    <th>Status</th>
                    <th>Agreement</th>
                </tr>
            </thead>
            <tbody><?php foreach ($loans as $a): ?>
                    <tr>
                        <td>UW-<?= $a['agreement_id'] ?></td>
                        <td><?= money($a['principal']) ?></td>
                        <td><?= e($a['released_at'] ? substr($a['released_at'], 0, 10) : 'Awaiting release') ?></td>
                        <td><?= e($a['last_due']) ?></td>
                        <td><?= e(loan_status($a)) ?></td>
                        <td><a href="../controllers/borrower-agreement.php?id=<?= $a['agreement_id'] ?>">Download</a></td>
                    </tr><?php endforeach;
            if (!$loans): ?>
                    <tr>
                        <td colspan="6">No loans yet.</td>
                    </tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<section class="portal-card">
    <h2>Overall loan summary</h2>
    <p>Released principal: <?= money($principal) ?></p>
    <p>Total paid: <?= money($paid) ?></p>
    <p>Outstanding balance, including interest: <?= money($balance) ?></p>
    <p>Draft agreements are excluded from released totals. Extended schedules are included in the outstanding balance.
    </p>
</section><?php portal_end(); ?>