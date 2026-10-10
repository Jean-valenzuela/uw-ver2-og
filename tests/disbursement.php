<?php
require __DIR__ . '/../helpers/disbursement.php';
function check($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
$base = ['account_holder_name' => 'Test Borrower'];
$bank = validate_disbursement($base + ['receiving_method' => 'bank', 'bank_name' => 'BDO', 'bank_account_number' => '0012345678', 'gcash_mobile_number' => '09123456789']);
check($bank === ['bank', 'Test Borrower', 'BDO', '0012345678', null], 'Bank must preserve leading zeros and exclude GCash.');
$gcash = validate_disbursement($base + ['receiving_method' => 'gcash', 'gcash_mobile_number' => '09123456789', 'bank_name' => 'BDO', 'bank_account_number' => '0012345678']);
check($gcash === ['gcash', 'Test Borrower', null, null, '09123456789'], 'GCash must exclude bank fields.');
foreach ([
    $base + ['receiving_method' => 'cash'],
    ['receiving_method' => 'gcash', 'account_holder_name' => '', 'gcash_mobile_number' => '09123456789'],
    $base + ['receiving_method' => 'gcash', 'gcash_mobile_number' => '09123'],
    $base + ['receiving_method' => 'gcash', 'gcash_mobile_number' => '09123456789x'],
    $base + ['receiving_method' => 'bank', 'bank_account_number' => '0012345678'],
    $base + ['receiving_method' => 'bank', 'bank_name' => 'BDO', 'bank_account_number' => 'abcd'],
] as $input) {
    try { validate_disbursement($input); } catch (DomainException $e) { continue; }
    throw new RuntimeException('Invalid receiving details were accepted.');
}
echo "Disbursement validation checks passed.\n";
