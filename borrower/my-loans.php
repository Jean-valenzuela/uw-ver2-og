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
        <section class="summary-card"><div class="summary-icon <?= ['Total loans'=>'gold-icon','Active loans'=>'green-icon','Completed loans'=>'purple-icon','Overdue loans'=>'red-icon'][$k] ?>"><span class="material-symbols-outlined" aria-hidden="true"><?= ['Total loans'=>'description','Active loans'=>'autorenew','Completed loans'=>'check_circle','Overdue loans'=>'error'][$k] ?></span></div><div><span><?= e($k) ?></span><h3><?= $v ?></h3></div></section><?php endforeach; ?>
</div>
<div class="content-grid"><section class="portal-card loans-card"><label>Search loans <input data-filter-table="#borrowerLoans" type="search"></label>
    <div class="table-wrapper">
        <table id="borrowerLoans">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Loan amount</th>
                    <th>Date granted</th>
                    <th>Final due date</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody><?php foreach ($loans as $a): ?>
                    <tr>
                        <td>UW-<?= $a['agreement_id'] ?></td>
                        <td><?= money($a['principal']) ?></td>
                        <td><?= e($a['released_at'] ? substr($a['released_at'], 0, 10) : 'Awaiting release') ?></td>
                        <td><?= e($a['last_due']) ?></td>
                        <td><span class="loan-status <?= $a['status']==='completed'?'completed':($a['overdue']?'overdue':'ongoing') ?>"><?= e(loan_status($a)) ?></span></td>
                        <td><a href="loan-details.php?id=<?= $a['agreement_id'] ?>">View loan</a></td>
                    </tr><?php endforeach;
            if (!$loans): ?>
                    <tr>
                        <td colspan="6">No loans yet.</td>
                    </tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<aside class="right-column"><section class="portal-card side-card">
    <h2>Overall loan summary</h2>
    <p>Released principal: <?= money($principal) ?></p>
    <p>Total paid: <?= money($paid) ?></p>
    <p>Outstanding balance, including interest: <?= money($balance) ?></p>
    <p>Draft agreements are excluded from released totals. Extended schedules are included in the outstanding balance.
    </p>
<p><a class="portal-button" href="request-loan.php">Request another loan</a></p></section></aside></div><?php portal_end(); ?>