<?php
function validate_disbursement(array $input): array
{
    $method = trim($input['receiving_method'] ?? '');
    $holder = trim($input['account_holder_name'] ?? '');
    if (!in_array($method, ['bank', 'gcash'], true)) {
        throw new DomainException('Choose Bank Transfer or GCash as the receiving method.');
    }
    if ($holder === '' || mb_strlen($holder) > 150) {
        throw new DomainException('Enter the account holder name (up to 150 characters).');
    }
    $bank = $number = $mobile = null;
    if ($method === 'bank') {
        $bank = trim($input['bank_name'] ?? '');
        $number = trim($input['bank_account_number'] ?? '');
        if ($bank === '' || mb_strlen($bank) > 100) {
            throw new DomainException('Enter the bank name (up to 100 characters).');
        }
        if (!preg_match('/^[0-9][0-9 -]{3,39}$/D', $number)) {
            throw new DomainException('Enter a bank account number of 4 to 40 characters using digits, spaces or hyphens.');
        }
    } else {
        $mobile = trim($input['gcash_mobile_number'] ?? '');
        if (!preg_match('/^09[0-9]{9}$/D', $mobile)) {
            throw new DomainException('Enter an 11-digit GCash mobile number starting with 09.');
        }
    }
    return [$method, $holder, $bank, $number, $mobile];
}
