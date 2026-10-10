<?php require __DIR__ . '/../helpers/borrower_portal.php';
require __DIR__ . '/../vendor/tcpdf/tcpdf.php';
$u = borrower_user();
$rows = borrower_history($u['user_id']);
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
$pdf->SetMargins(16, 18, 16);
$pdf->SetAutoPageBreak(true, 18);
$pdf->SetTitle('Utang Wise payment history');
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 9);
$h = '<h1 style="color:#062347">UTANG WISE</h1><h2>Payment History</h2><p>Borrower: ' . e($u['user_fn'] . ' ' . $u['user_ln']) . '<br>Account: ' . e($u['email']) . '<br>Generated: ' . date('Y-m-d H:i') . ' (Asia/Manila)</p><table border="1" cellpadding="6"><thead><tr style="background-color:#eeeeee"><th width="15%">Payment</th><th width="20%">Date</th><th width="23%">Amount</th><th width="27%">Method</th><th width="15%">Status</th></tr></thead><tbody>';
$total = 0;
foreach ($rows as $r) {
    $total += cents($r['amount']);
    $h .= '<tr><td>PAY-' . (int) $r['payment_id'] . '</td><td>' . e($r['payment_date']) . '</td><td>' . money($r['amount']) . '</td><td>' . e($r['method']) . '</td><td>Paid</td></tr>';
}
if (!$rows)
    $h .= '<tr><td colspan="5">No confirmed payments recorded.</td></tr>';
$h .= '</tbody></table><p><b>Total confirmed payments: ' . money($total / 100) . '</b></p><p>Pending and unconfirmed checkouts are excluded. This is a payment-history statement, not a tax invoice.</p>';
$pdf->writeHTML($h);
header('Cache-Control: no-store');
$pdf->Output('utang-wise-payment-history.pdf', 'D');