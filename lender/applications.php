<?php $mode='applications'; require __DIR__.'/../controllers/lender-page.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($title) ?> | Utang Wise</title>

    <!-- APPLICATIONS CSS -->
    <link rel="stylesheet" href="../assets/css/applications.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" href="../assets/css/lender-flow.css">

    <!-- GOOGLE FONTS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL ICONS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
<link rel="stylesheet" href="../assets/css/lender-live.css"></head>

<body>

<div class="admin-layout">

    <!-- ==================================================
         SIDEBAR
    =================================================== -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu"><?php foreach (['dashboard'=>'Dashboard','applications'=>'Applications','loaners'=>'Loaners','loans'=>'Loans','payments'=>'Payments','extension-requests'=>'Extension Requests'] as $key=>$name): ?><a href="<?= e($key) ?>.php" class="menu-item <?= $mode===$key?'active':'' ?>"><?= e($name) ?></a><?php endforeach; ?><form class="uw-logout" method="post" action="../ajax/logout.php"><?php csrf(); ?><button class="uw-button secondary" type="submit">Log out</button></form></nav>


        <div class="sidebar-divider"></div>


        <nav class="sidebar-menu sidebar-bottom">

            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    settings
                </span>

                Settings

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    support_agent
                </span>

                Help & Support

            </a>


            

        </nav>


        <div class="security-box">

            <div class="security-icon">

                <span class="material-symbols-outlined">
                    verified_user
                </span>

            </div>

            <div>

                <strong>
                    Secure & Trusted
                </strong>

                <p>
                    Client information is protected
                    and handled securely.
                </p>

            </div>

        </div>

    </aside>


    <!-- ==================================================
         MAIN CONTENT
    =================================================== -->
    <main class="main-content"><?php $lenderAccount=$lender;require __DIR__.'/../helpers/lender_topbar.php'; ?><div class="page-content"><?php require __DIR__.'/../helpers/lender_view.php'; ?></div></main></div><script src="../assets/js/datatables.min.js"></script><script src="../assets/js/lender-flow.js"></script><script src="../assets/js/lender-notifications.js"></script><?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body></html>