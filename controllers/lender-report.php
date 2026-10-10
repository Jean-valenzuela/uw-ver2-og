<?php
require __DIR__ . '/../helpers/lender_dashboard.php';
$u = lender_user();
$year = (int) ($_GET['year'] ?? date('Y'));
if ($year < 2000 || $year > 2100) {
    http_response_code(422);
    exit('Choose a year from 2000 to 2100.');
}
$data = lender_dashboard_data($u['user_id'], $year);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="lending-payments-' . $year . '.csv"');
$out = fopen('php://output', 'w');
fputcsv($out, ['Month', 'Amount lent (PHP)', 'Payments received (PHP)']);
foreach ($data['months'] as $m)
    fputcsv($out, [$m['month'] . ' ' . $year, number_format($m['lent'] / 100, 2, '.', ''), number_format($m['paid'] / 100, 2, '.', '')]);
fputcsv($out, ['Total', number_format(array_sum(array_column($data['months'], 'lent')) / 100, 2, '.', ''), number_format(array_sum(array_column($data['months'], 'paid')) / 100, 2, '.', '')]);
fputcsv($out, ['Basis', 'Actual recorded release dates and payment dates. Undated historical amounts are excluded.']);
fclose($out);
