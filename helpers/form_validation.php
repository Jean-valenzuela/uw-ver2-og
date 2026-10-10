<?php
// JSON transport for form submissions; validation stays on the original page.
function uw_form_request() {
    return ($_SERVER['HTTP_X_UW_FORM'] ?? '') === '1';
}
function uw_field_message($field, $message) {
    $GLOBALS['uw_error_field'] = $field;
    return $message;
}
function uw_error_field($message) {
    if (!empty($GLOBALS['uw_error_field'])) return $GLOBALS['uw_error_field'];
    $text = strtolower(str_replace(['_', '-'], ' ', $message));
    $names = array_keys($_POST);
    usort($names, fn($a, $b) => strlen($b) <=> strlen($a));
    foreach ($names as $name) {
        if (in_array($name, ['csrf', 'step', 'action', 'decision', 'portal'], true)) continue;
        if (strpos($text, strtolower(str_replace(['_', '-'], ' ', $name))) !== false) return $name;
    }
    $aliases = [
        'reference email'=>['reference_email'], 'reference contact'=>['reference_contact'],
        '21 years'=>['birth_date'], 'password'=>['confirm-password','password'],
        'email'=>['email'], 'mobile'=>['mobile','phone'], 'phone'=>['phone','mobile'],
        'postal'=>['reference_zip','zip_code'], 'barangay'=>['reference_barangay','barangay'],
        'profile photo'=>['profile_photo','lender_photo'], 'photo'=>['lender_photo','profile_photo'],
        'valid id'=>['valid_id'], 'certificate'=>['coe'], 'proof of funds'=>['source_proof'],
        'signed agreement'=>['signed_agreement'], 'confirm'=>['confirm_terms','confirm_release','confirm_carry','confirm'],
        'first due'=>['first_due_date'], 'payment date'=>['payment_date'],
        'rejection reason'=>['reason','note'], 'review note'=>['note'],
        'principal'=>['principal'], 'interest percentage'=>['monthly_interest_percent'],
        'interest rate'=>['monthly_interest_percent'], 'installments'=>['term_months'],
        'loan amount'=>['loan_amount','amount'], 'amount'=>['amount','loan_amount','principal'],
        'purpose'=>['purpose','loan_purpose'], 'terms'=>['terms','confirm_terms'],
    ];
    foreach ($aliases as $word=>$fields) {
        if (strpos($text, $word) === false) continue;
        foreach ($fields as $field) if (array_key_exists($field, $_POST) || array_key_exists($field, $_FILES)) return $field;
    }
    return null;
}
function uw_form_json($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}
function uw_form_error($message, $field = null, $status = 422) {
    uw_form_json(['ok'=>false, 'error'=>$message, 'field'=>$field ?: uw_error_field($message)], $status);
}
