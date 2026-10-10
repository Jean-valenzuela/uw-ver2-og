<?php $mode='loaners'; require __DIR__.'/../controllers/lender-page.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($title) ?> | Utang Wise</title>

    <!-- APPLICATIONS CSS -->
    

    <!-- DATATABLES -->
    <link rel="stylesheet" href="../assets/css/integ-lender/lender-flow.css?v=20261010">

    <!-- GOOGLE FONTS -->
    

    <!-- MATERIAL ICONS -->
    
<link rel="stylesheet" href="../assets/css/integ-lender/lender-live.css?v=20261010"><?php uw_role_design_assets('lender', basename(__FILE__, '.php')); ?><link rel="stylesheet" href="<?= e(base_url()) ?>/assets/css/local-fonts.css"></head>

<body>

<div class="admin-layout">

    <!-- ==================================================
         SIDEBAR
    =================================================== -->
    <?php require __DIR__.'/../helpers/lender_sidebar.php'; ?>


    <!-- ==================================================
         MAIN CONTENT
    =================================================== -->
    <main class="main-content"><?php $lenderAccount=$lender;require __DIR__.'/../helpers/lender_topbar.php'; ?><div class="page-content"><?php require __DIR__.'/../helpers/lender_view.php'; ?></div></main></div><script src="../assets/js/datatables.min.js"></script><script src="../assets/js/lender-flow.js?v=20261010"></script><script src="../assets/js/lender-notifications.js"></script><?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body></html>