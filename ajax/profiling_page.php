<?php
require_once __DIR__.'/borrower.php';
$u = borrower_user(true);
$p = profile($u['user_id']);
$complete = borrower_complete($u['user_id'], $p);
$values = $p[$step] ?? [];
if (($_SESSION['borrower_old']['step'] ?? '') === $step) {
    $values = $_SESSION['borrower_old']['values'];
    unset($_SESSION['borrower_old']);
}
if ($step === 'personal-details') {
    $values += ['first_name'=>$u['user_fn'], 'last_name'=>$u['user_ln'], 'mobile'=>preg_replace('/^(?:\+63|0)/','',$u['phone'])];
    $values['email'] = $u['email'];
}
if ($step === 'idverification') $values += ['id_type'=>'Passport'];
