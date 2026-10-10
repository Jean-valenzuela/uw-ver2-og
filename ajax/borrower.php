<?php
require_once __DIR__ . '/app.php';
header('Cache-Control: no-store, private');

function borrower_user($profiling = false) {
    $u = require_user(2);
    if ($profiling && $u['account_status'] !== 'incomplete') go(destination($u));
    if (!$profiling && $u['account_status'] !== 'approved') go(destination($u));
    if (!$profiling && !defined('UW_AGREEMENT_PAGE') && borrower_needs_agreement($u['user_id'])) go('borrower/signed-agreement.php');
    return $u;
}

function borrower_schema() {
    return json_decode(file_get_contents(__DIR__ . '/borrower-fields.json'), true);
}

function borrower_address($data, $prefix = '') {
    $tree = json_decode(file_get_contents(__DIR__ . '/../assets/data/addresses.json'), true);
    $r = $tree[$data[$prefix.'region'] ?? ''] ?? null;
    $p = $r[$data[$prefix.'province'] ?? ''] ?? null;
    $c = $p[$data[$prefix.'city'] ?? ''] ?? null;
    $b = $c[$data[$prefix.'barangay'] ?? ''] ?? null;
    if ($b === null) {
        $branch=$tree ?? $r;
        foreach (['region','province','city','barangay'] as $part) {
            $field=$prefix.$part;
            if (!is_array($branch) || !array_key_exists($data[$field] ?? '',$branch)) throw new RuntimeException(uw_field_message($field,'Please select a valid '. $part .'.'));
            $branch=$branch[$data[$field]];
        }
    }
    $zipKey = $prefix ? $prefix.'zip' : 'zip_code';
    if (!in_array($data[$zipKey] ?? '', $b, true)) throw new RuntimeException(uw_field_message($zipKey,'Please select the postal area for your address.'));
}

function validate_borrower_step($step, $input) {
    unset($GLOBALS['uw_error_field']);
    $schema = borrower_schema()[$step] ?? null;
    if (!$schema) throw new RuntimeException('Invalid profiling step.');
    $out = [];
    foreach ($schema as $key => $rule) {
        $value = trim($input[$key] ?? '');
        if (strlen($value) > 2000) throw new RuntimeException(uw_field_message($key,'This field must be 2,000 characters or fewer.'));
        if (($rule['required'] ?? false) && $value === '') throw new RuntimeException(uw_field_message($key,'Please complete '.str_replace('_', ' ', $key).'.'));
        if ($value !== '' && isset($rule['options']) && !in_array($value, $rule['options'], true)) throw new RuntimeException(uw_field_message($key,'Invalid choice for '.str_replace('_', ' ', $key).'.'));
        $out[$key] = $value;
    }
    if ($step === 'personal-details') {
        $birth = DateTimeImmutable::createFromFormat('!Y-m-d', $out['birth_date']);
        $today = new DateTimeImmutable('today');
        if (!$birth || $birth->format('Y-m-d') !== $out['birth_date'] || $birth > $today || $birth->diff($today)->y < 21) throw new RuntimeException(uw_field_message('birth_date','You must be at least 21 years old.'));
        if (!preg_match('/^9[0-9]{9}$/D', $out['mobile'])) throw new RuntimeException(uw_field_message('mobile','Enter 10 mobile digits starting with 9 after +63.'));
        borrower_address($out);
    }
    if ($step === 'reference-person') {
        if (!preg_match('/^9[0-9]{9}$/D', $out['reference_contact'])) throw new RuntimeException(uw_field_message('reference_contact','Enter 10 reference contact digits starting with 9 after +63.'));
        if ($out['reference_email'] !== '' && !filter_var($out['reference_email'], FILTER_VALIDATE_EMAIL)) throw new RuntimeException(uw_field_message('reference_email','Enter a valid reference email.'));
        borrower_address($out, 'reference_');
    }
    if ($step === 'financial-details') {
        foreach (['gross_income','expenses','other_income','loan_balance'] as $key) {
            $value = $out[$key] ?? '';
            if ($value === '') $value = '0';
            if (!preg_match('/^\d{1,9}(\.\d{1,2})?$/D', $value)) throw new RuntimeException(uw_field_message($key,'Enter a valid non-negative amount for '.str_replace('_',' ',$key).'.'));
            $out[$key] = $value;
        }
        if (($out['has_other_income'] ?? '') !== 'yes') { $out['other_income'] = '0'; $out['income_source'] = ''; }
        elseif ($out['income_source'] === '' || (float)$out['other_income'] <= 0) throw new RuntimeException(uw_field_message($out['income_source']===''?'income_source':'other_income','Provide the source and amount of your other income, or select No.'));
        if (($out['has_loans'] ?? '') !== 'yes') $out['loan_balance'] = '0';
        if ($out['employment_status'] === 'employed') {
            foreach (['company','job_title','work_type','years_job'] as $key) if ($out[$key] === '') throw new RuntimeException(uw_field_message($key,'Complete your employment information.'));
        }
        $out['total_income'] = number_format((float)$out['gross_income'] + (float)$out['other_income'], 2, '.', '');
    }
    if ($step === 'loan-preferences' && (!preg_match('/^\d+(\.\d{1,2})?$/D', $out['loan_amount']) || !in_array((float)$out['loan_amount'], [3000.0, 5000.0, 10000.0, 15000.0], true))) throw new RuntimeException(uw_field_message('loan_amount','Choose a loan amount of PHP 3,000, 5,000, 10,000, or 15,000.'));
    return $out;
}

function borrower_complete($id, $profile) {
    $account=db('SELECT account_status FROM users WHERE user_id=?',[$id])->get_result()->fetch_assoc();
    $photoRequired=($account['account_status']??'')==='incomplete'||!empty($profile['idverification']['profile_photo_required']);
    $result = [];
    foreach (borrower_schema() as $step => $unused) {
        try {
            if (empty($profile[$step])) throw new RuntimeException('Not saved.');
            validate_borrower_step($step, $profile[$step]);
            if ($step === 'idverification' && $photoRequired && !document_exists($id, 'profile_photo')) throw new RuntimeException('Missing profile photo.');
            if ($step === 'idverification' && !document_exists($id, 'valid_id')) throw new RuntimeException('Missing ID.');
            if ($step === 'financial-details' && $profile[$step]['employment_status'] === 'employed' && !document_exists($id, 'coe')) throw new RuntimeException('Missing certificate.');
            $result[$step] = true;
        } catch (RuntimeException $error) { $result[$step] = false; }
    }
    unset($GLOBALS['uw_error_field']);
    return $result;
}

function borrower_logout_button() {
    echo '<form class="uw-logout" action="'.e(base_url()).'/ajax/logout.php" method="post">';
    csrf();
    echo '<button type="submit" class="back-button">Log out</button></form>';
}

function borrower_address_fields($prefix, $values) {
    echo '<div class="form-section address-section"><h2>Address</h2><div class="form-grid three-columns">';
    foreach (['region'=>'Region', 'province'=>'Province / Area', 'city'=>'City / Municipality', 'barangay'=>'Barangay'] as $key=>$label) {
        $name = $prefix.$key;
        echo '<div class="form-group"><label for="'.e($name).'">'.e($label).'</label><select id="'.e($name).'" name="'.e($name).'" data-address="'.e($key).'" required><option value="">Select '.e(strtolower($label)).'</option></select></div>';
    }
    $name = $prefix.'street';
    echo '<div class="form-group"><label for="'.e($name).'">Block / Lot / House No. / Street</label><input type="text" id="'.e($name).'" name="'.e($name).'" value="'.e($values[$name] ?? '').'" required maxlength="255"></div>';
    $key = $prefix ? 'zip' : 'zip_code';
    $name = $prefix.$key;
    echo '<div class="form-group"><label for="'.e($name).'">ZIP Code (automatic)</label><select id="'.e($name).'" name="'.e($name).'" data-address="'.e($key).'" required><option value="">Select an address first</option></select></div></div></div>';
}
