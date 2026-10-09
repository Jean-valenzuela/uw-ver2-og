<?php notice(); ?>
<div class="review-layout"><section class="review-panel">
<article class="uw-review-card"><h2>Account</h2><p><?= e($u['user_fn'].' '.$u['user_ln']) ?> · <?= e($u['email']) ?></p>
<?php $lender=selected_lender($u['selected_lender_id']); ?><p>Selected lender: <?= e($lender ? $lender['user_fn'].' '.$lender['user_ln'] : 'Unavailable') ?></p></article>
<?php foreach (borrower_schema() as $key=>$fields): ?>
<article class="uw-review-card"><h2><?= e(ucwords(str_replace('-', ' ', $key))) ?> — <?= $complete[$key] ? 'Complete' : 'Needs attention' ?></h2>
<dl class="uw-review-values">
<?php foreach ($fields as $name=>$rule): ?><dt><?= e(ucwords(str_replace('_',' ',$name))) ?></dt><dd><?= e(($p[$key][$name] ?? '') !== '' ? (in_array($name,['mobile','reference_contact'],true) ? '+63 ' : '').$p[$key][$name] : 'Not provided') ?></dd><?php endforeach; ?>
</dl>
<?php $kind = $key === 'idverification' ? 'valid_id' : ($key === 'financial-details' ? 'coe' : null); if ($kind && document_exists($u['user_id'],$kind)): ?><p><a href="../../ajax/borrower_document.php?kind=<?= e($kind) ?>">Download saved <?= $kind === 'coe' ? 'certificate of employment' : 'ID' ?></a></p><?php endif; ?>
<a href="<?= e($key) ?>.php" class="back-link">Edit this section</a></article>
<?php endforeach; ?>
<form class="uw-review-card" action="../../ajax/save_borrower.php" method="post"><?php csrf(); ?><input type="hidden" name="step" value="submit">
<label><input type="checkbox" name="confirm" value="yes" required> I confirm that the information above is accurate.</label>
<p>Submitting sends your account application to your selected lender for review. You can access the borrower dashboard after approval.</p>
<button class="submit-button" type="submit" <?= in_array(false,$complete,true) ? 'disabled' : '' ?>>Submit application</button>
</form></section></div>
