<?php
require __DIR__.'/../../ajax/app.php';header('Cache-Control: no-store, private');$u=require_user(1);
if($u['account_status']!=='incomplete'){if($u['account_status']==='approved')go(destination($u));unset($_SESSION['uid']);go('login.php');}
$v=(profile($u['user_id'])?:[])['requirements']??[];
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Lender Requirements | Utang Wise</title><link rel="stylesheet" href="../../assets/css/superadmin.css"><link rel="stylesheet" href="../../assets/css/admin-flow.css"><?php uw_role_design_assets('lender', basename(__FILE__, '.php')); ?></head><body><main class="requirements-page"><h1>Lender Requirements</h1><p>Submit these requirements for administrator review.</p><?php notice(); ?>
<form method="post" action="../../controllers/lender-submit.php" enctype="multipart/form-data" class="admin-form"><?php csrf(); ?>
<label>Source of funds<textarea name="source_of_funds" maxlength="1000" required><?= e($v['source_of_funds']??'') ?></textarea></label>
<label>Lending limit (PHP)<input type="number" name="lending_limit" min="0.01" max="9999999999.99" step="0.01" value="<?= e($v['lending_limit']??'') ?>" required></label>
<label>Reason for becoming a lender<textarea name="lender_reason" maxlength="2000" required><?= e($v['lender_reason']??'') ?></textarea></label>
<label>Proof of source of funds<input type="file" name="source_proof" accept=".png,.jpg,.jpeg,.pdf" required></label>
<label>Valid ID<input type="file" name="valid_id" accept=".png,.jpg,.jpeg,.pdf" required></label>
<label>Profile picture<input type="file" name="lender_photo" accept=".png,.jpg,.jpeg" required></label><p>Your profile picture will be shown on the public lenders list after the administrator approves your application.</p><p>Documents: PNG, JPG or PDF. Photo: JPG or PNG. Up to 5 MB each.</p><button type="submit" class="approve-btn">Submit for review</button></form>
<form method="post" action="../../ajax/logout.php"><?php csrf(); ?><button class="view-btn">Log out</button></form></main><?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body></html>
