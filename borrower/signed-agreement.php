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
                    accept=".pdf,application/pdf" required></label>
            <section class="disbursement-card" aria-labelledby="disbursement-title">
                <span class="disbursement-eyebrow">Loan disbursement details</span>
                <h2 id="disbursement-title">Where should we send your loan?</h2>
                <p>Choose GCash or bank transfer and provide your receiving account details. A QR code image is optional.</p>
                <div class="disbursement-grid">
                    <label>Receiving Method<select name="receiving_method" id="receiving-method" required>
                        <option value="gcash">GCash</option><option value="bank">Bank Transfer</option>
                    </select></label>
                    <label>Account Holder Name<input name="account_holder_name" maxlength="150" placeholder="Name registered to the account" required></label>
                    <label data-receiving="gcash">GCash Mobile Number<input name="gcash_mobile_number" type="tel" inputmode="numeric" pattern="09[0-9]{9}" maxlength="11" placeholder="09XXXXXXXXX" title="11 digits starting with 09" required></label>
                    <label data-receiving="bank" hidden>Bank Name<input name="bank_name" maxlength="100" placeholder="e.g. BDO, BPI, UnionBank" disabled></label>
                    <label data-receiving="bank" hidden>Bank Account Number<input name="bank_account_number" inputmode="numeric" pattern="[0-9][0-9 \-]{3,39}" maxlength="40" placeholder="Enter bank account number" disabled></label>
                </div>
                <label class="disbursement-qr">Upload receiving QR code (optional)
                    <small>PNG or JPG &middot; Maximum 3 MB</small>
                    <input type="file" name="receiving_qr" accept=".png,.jpg,.jpeg,image/png,image/jpeg">
                </label>
                <p class="disbursement-note">These details are for receiving your loan, not making repayments. Agreement approval does not automatically transfer funds.</p>
            </section>
            <label class="check"><input type="checkbox"
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
?>
<script src="../assets/js/borrower-disbursement.js"></script>
<?php portal_end(); ?>
