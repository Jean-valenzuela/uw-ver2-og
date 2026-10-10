<?php define('UW_AGREEMENT_PAGE', true);
require __DIR__ . '/../helpers/borrower_portal.php';
$borrowerAccount = borrower_user();
$loans = borrower_loans($borrowerAccount['user_id']);
$a = $loans[0] ?? null;
portal_start('Signed loan agreement', 'signed-agreement'); ?>
<section class="portal-card"><?php if (!$a): ?>
        <p>Your lender has not issued a loan agreement yet. Please contact your lender.</p>
    <?php elseif (!$a['has_signed']): ?>
        <h2>Upload your signed agreement</h2>
        <p>Sign the agreement sent by your lender, then upload the complete PDF to access your dashboard. Loan release is
            confirmed separately by your lender.</p>
        <p><a href="../controllers/borrower-agreement.php?id=<?= $a['agreement_id'] ?>">Download agreement
                UW-<?= $a['agreement_id'] ?></a></p>
        <form class="portal-form" method="post" action="../controllers/borrower-agreement.php"
            enctype="multipart/form-data"><?php csrf(); ?><input type="hidden" name="agreement_id"
                value="<?= $a['agreement_id'] ?>"><label>Signed PDF (up to 5 MB)<input type="file" name="signed_agreement"
                    accept=".pdf,application/pdf" required></label><label class="check"><input type="checkbox"
                    name="confirm" value="yes" required>I confirm this is my signed copy of the
                agreement.</label><button>Submit signed agreement</button></form><?php else: ?>
        <p>Your signed agreement has been submitted.</p><a class="portal-button" href="client-dashboard.php">Go to
            dashboard</a><?php endif; ?>
</section><?php foreach ($loans as $loan): ?>
    <section class="portal-card">
        <h2>UW-<?= $loan['agreement_id'] ?></h2><a
            href="../controllers/borrower-agreement.php?id=<?= $loan['agreement_id'] ?>">Original
            agreement</a><?php if ($loan['has_signed']): ?> · <a
                href="../controllers/borrower-agreement.php?id=<?= $loan['agreement_id'] ?>&signed=1">Signed
                copy</a><?php endif; ?>
    </section><?php endforeach;
portal_end(); ?>