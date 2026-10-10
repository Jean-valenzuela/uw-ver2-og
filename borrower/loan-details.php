<?php
require __DIR__.'/../helpers/borrower_portal.php';
$borrowerAccount=borrower_user();
$id=(int)($_GET['id']??0);
$matches=array_filter(borrower_loans($borrowerAccount['user_id']),fn($loan)=>(int)$loan['agreement_id']===$id);
$a=$matches?reset($matches):null;
if(!$a){http_response_code(404);portal_start('Loan not found','my-loans');echo '<section class="portal-card">This loan is unavailable. <a href="my-loans.php">Back to your loans</a></section>';portal_end();exit;}
portal_start('Loan UW-'.$id,'my-loans');
?>
<section class="portal-card"><h2>Loan details</h2><div class="portal-grid">
<p>Original principal<strong class="portal-amount"><?= money($a['principal']) ?></strong></p>
<p>Flat monthly interest<strong class="portal-amount"><?= e($a['monthly_interest_percent']) ?>%</strong></p>
<p>Original term<strong class="portal-amount"><?= (int)$a['term_months'] ?> months</strong></p>
<p>Status<strong class="portal-amount"><?= e(loan_status($a)) ?></strong></p></div>
<p>Purpose: <?= e($a['purpose']?:'Not recorded') ?></p>
<p>Released: <?= e($a['released_at']?:'Awaiting lender confirmation') ?></p>
<p>Total paid: <?= money($a['paid']) ?> · Remaining: <?= money(max(0,$a['total_due']-$a['paid'])) ?></p>
<a class="portal-button" href="../controllers/borrower-agreement.php?id=<?= $id ?>">Download agreement</a>
<?php if($a['has_signed']): ?><a class="portal-button" href="../controllers/borrower-agreement.php?id=<?= $id ?>&signed=1">Signed copy</a><?php endif; ?>
</section>
<section class="portal-card"><h2>Installment schedule</h2><p>Amounts reflect confirmed payments and any principal carried to a later installment.</p><div class="table-wrapper"><table><thead><tr><th>Due ID</th><th>Due date</th><th>Amount due</th><th>Paid</th><th>Remaining</th><th>Status</th></tr></thead><tbody>
<?php foreach(lender_rows('SELECT * FROM loan_installments WHERE agreement_id=? ORDER BY due_date,installment_number',[$id]) as $i): $remaining=max(0,$i['amount_due']-$i['amount_paid']); ?>
<tr><td>DUE-<?= (int)$i['installment_id'] ?></td><td><?= e($i['due_date']) ?></td><td><?= money($i['amount_due']) ?></td><td><?= money($i['amount_paid']) ?></td><td><?= money($remaining) ?></td><td><?= $remaining?e($a['status']==='draft'?'Awaiting release':due_status($i['due_date'])):'Settled' ?></td></tr>
<?php endforeach; ?></tbody></table></div></section>
<section class="portal-card"><h2>Payments for this loan</h2><?php portal_history_table(array_filter(borrower_history($borrowerAccount['user_id']),fn($p)=>(int)$p['agreement_id']===$id)); ?><a href="my-loans.php">Back to all loans</a></section>
<?php portal_end(); ?>
