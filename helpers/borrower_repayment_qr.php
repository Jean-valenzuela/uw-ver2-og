<?php
$repaymentQrs = lender_rows("SELECT a.agreement_id,a.status FROM loan_agreements a JOIN loan_repayment_qr q ON q.agreement_id=a.agreement_id WHERE a.borrower_id=? AND a.status IN ('draft','active') ORDER BY a.agreement_id DESC", [$borrowerAccount['user_id']]);
foreach ($repaymentQrs as $repaymentQr):
    $qrUrl = '../controllers/repayment-qr.php?agreement_id=' . (int) $repaymentQr['agreement_id'];
?>
<section class="portal-card">
    <h2>Lender payment QR &middot; Loan UW-<?= (int) $repaymentQr['agreement_id'] ?></h2>
    <p>Scan this QR code in your payment app to pay your lender. Check the recipient and amount before confirming.</p>
    <img src="<?= e($qrUrl) ?>" alt="Lender repayment QR for loan UW-<?= (int) $repaymentQr['agreement_id'] ?>" style="display:block;width:280px;max-width:100%;height:auto;margin:16px 0" loading="lazy">
    <a class="portal-button" href="<?= e($qrUrl) ?>&amp;download=1">Download payment QR</a>
    <?php if ($repaymentQr['status'] === 'draft'): ?><p>Your loan is awaiting release confirmation.</p><?php endif; ?>
    <p>Keep your payment receipt and contact your lender to have the payment recorded. Paying through this QR does not automatically update your loan balance.</p>
</section>
<?php endforeach; ?>
