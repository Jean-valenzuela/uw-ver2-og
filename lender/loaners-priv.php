<?php require_once __DIR__.'/../helpers/lending.php'; $lenderAccount=lender_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Profile | Utang Wise</title>

    <link rel="stylesheet" href="../css/loaners-priv.css">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="admin-layout">

    <!-- ====================================
         SIDEBAR
    ===================================== -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div>
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    home
                </span>

                Dashboard
            </a>


            <a href="#" class="menu-item active">
                <span class="material-symbols-outlined">
                    groups
                </span>

                Loaners
            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    description
                </span>

                Applications

                <span class="menu-badge">
                    3
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    schedule
                </span>

                Extension Requests

                <span class="menu-badge">
                    1
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>

                Debts / Loans

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    bar_chart
                </span>

                Payments

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    history
                </span>

                Reports

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    contract
                </span>

                Legal Agreements

            </a>

        </nav>


        <div class="sidebar-divider"></div>


        <nav class="sidebar-menu bottom-menu">

            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    settings
                </span>

                Settings

            </a>



            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    logout
                </span>

                Log Out

            </a>

        </nav>


        <div class="security-box">

            <span class="material-symbols-outlined">
                lock
            </span>

            <div>

                <h4>
                    Secure & Trusted
                </h4>

                <p>
                    Client information is protected
                    and handled securely.
                </p>

            </div>

        </div>

    </aside>


    <!-- ====================================
         MAIN
    ===================================== -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search client name, phone number, or ID..."
                >

            </div>


            <div class="top-user">

                <span class="material-symbols-outlined notification">
                    notifications
                </span>

                <div class="admin-avatar">

                    <span class="material-symbols-outlined">
                        person
                    </span>

                </div>


                <div class="admin-text">

                    <strong>
                        Admin
                    </strong>

                    <span>
                        Loan Officer
                    </span>

                </div>


                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- ====================================
             PAGE CONTENT
        ===================================== -->
        <div class="page-content">

            <!-- PAGE HEADING -->
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">
                        Loaners
                        <span>›</span>
                        Client Profile
                    </div>


                    <h1>
                        Client Profile
                    </h1>


                    <p>
                        View and manage client information,
                        loans, and documents.
                    </p>

                </div>


                <div class="heading-actions">

                    <a href="#" class="secondary-button">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to Loaners

                    </a>


                    <a href="#" class="primary-button">

                        <span class="material-symbols-outlined">
                            edit
                        </span>

                        Edit Profile

                    </a>

                </div>

            </div>


            <!-- ====================================
                 TOP GRID
            ===================================== -->
            <div class="top-grid">


                <!-- CLIENT PROFILE -->
                <section class="client-card">

                    <div class="profile-image">

                        <span class="material-symbols-outlined">
                            person
                        </span>

                    </div>


                    <div class="client-info">

                        <div class="client-name-row">

                            <h2>
                                Juan Dela Cruz
                            </h2>


                            <span class="client-badge">
                                Existing Client
                            </span>


                            <span class="payer-badge">
                                ✓ Good Payer
                            </span>

                        </div>


                        <div class="client-contact">

                            <p>

                                <span class="material-symbols-outlined">
                                    call
                                </span>

                                +63 912 345 6789

                                <span class="verified">
                                    ✓ Verified
                                </span>

                            </p>


                            <p>

                                <span class="material-symbols-outlined">
                                    mail
                                </span>

                                juan@email.com

                            </p>


                            <p>

                                <span class="material-symbols-outlined">
                                    location_on
                                </span>

                                123 Mabini St., Manila

                            </p>


                            <p>

                                <span class="material-symbols-outlined">
                                    calendar_month
                                </span>

                                28 years old (May 14, 1997)

                            </p>

                        </div>

                    </div>


                    <!-- QUICK INFORMATION -->
                    <div class="quick-client-info">

                        <div>

                            <span class="material-symbols-outlined">
                                work
                            </span>

                            <p>
                                <small>
                                    Occupation
                                </small>

                                Office Staff
                            </p>

                        </div>


                        <div>

                            <span class="material-symbols-outlined">
                                payments
                            </span>

                            <p>
                                <small>
                                    Monthly Income
                                </small>

                                ₱25,000
                            </p>

                        </div>


                        <div>

                            <span class="material-symbols-outlined">
                                sell
                            </span>

                            <p>
                                <small>
                                    Type of Loaned
                                </small>

                                Money
                            </p>

                        </div>

                    </div>

                </section>


                <!-- ====================================
                     LOAN SUMMARY
                ===================================== -->
                <aside class="loan-summary-card">

                    <div class="summary-title">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                        <h3>
                            Loan Summary
                        </h3>

                    </div>


                    <div class="summary-grid">

                        <div class="summary-box">

                            <span class="material-symbols-outlined">
                                payments
                            </span>

                            <p>
                                Total Loan
                            </p>

                            <strong>
                                ₱35,000.00
                            </strong>

                            <small>
                                All loans
                            </small>

                        </div>


                        <div class="summary-box">

                            <span class="material-symbols-outlined">
                                calendar_month
                            </span>

                            <p>
                                Total Due
                            </p>

                            <strong>
                                ₱8,500.00
                            </strong>

                            <small>
                                Remaining
                            </small>

                        </div>

                    </div>


                    <div class="payer-label">

                        <div class="star-icon">

                            <span class="material-symbols-outlined">
                                star
                            </span>

                        </div>


                        <div>

                            <span>
                                Client Label
                            </span>

                            <h3>
                                Good Payer
                            </h3>

                            <p>
                                Based on payment history
                                and behavior.
                            </p>

                        </div>

                    </div>

                </aside>

            </div>


            <!-- ====================================
                 TABS
            ===================================== -->
         <div class="tabs">

            <a href="loaners.php" class="tab active">
        <span class="material-symbols-outlined">
            person
        </span>
        Basic Information
                 </a>

                 <a href="supporting-documents.php" class="tab">
        <span class="material-symbols-outlined">
            description
        </span>
        Supporting Documents
                  </a>

    <a href="loan-history.php" class="tab">
        <span class="material-symbols-outlined">
            history
        </span>
        Loan History
    </a>

    <a href="legal-agreements.php" class="tab">
        <span class="material-symbols-outlined">
            contract
        </span>
        Legal Agreements
    </a>

    <a href="reference-person-admin.php" class="tab">
        <span class="material-symbols-outlined">
            groups
        </span>
        Reference Person
    </a>

</div>


            <!-- ====================================
                 INFORMATION GRID
            ===================================== -->
            <div class="information-grid">


                <!-- BASIC INFORMATION -->
                <section class="info-card large-card">

                    <div class="card-title">

                        <div>

                            <span class="material-symbols-outlined">
                                person
                            </span>

                            <h3>
                                Basic Information
                            </h3>

                        </div>


                        <button class="edit-small">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="basic-grid">


                        <div class="detail-row">

                            <span>
                                Full Name
                            </span>

                            <strong>
                                Juan Dela Cruz
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Email Address
                            </span>

                            <strong>
                                juan@email.com
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Phone Number
                            </span>

                            <strong>
                                +63 912 345 6789
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Age
                            </span>

                            <strong>
                                28
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Address
                            </span>

                            <strong>
                                123 Mabini St., Manila
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Monthly Income
                            </span>

                            <strong>
                                ₱25,000
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Date of Birth
                            </span>

                            <strong>
                                May 14, 1997
                            </strong>

                        </div>


                        


                        <div class="detail-row">

                            <span>
                                Occupation
                            </span>

                            <strong>
                                Office Staff
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Status
                            </span>

                            <strong class="good-payer-text">
                                Good Payer
                            </strong>

                        </div>

                    </div>

                </section>



                <!-- ====================================
                     ACTIONS
                ===================================== -->
                <aside class="actions-card">

                    <div class="actions-title">

                        <span class="material-symbols-outlined">
                            settings
                        </span>

                        <h3>
                            Actions
                        </h3>

                    </div>


                    <button class="approve-button">

                        <span class="material-symbols-outlined">
                            check_circle
                        </span>

                        Approve Loan Application

                    </button>


                    <button class="deny-button">

                        <span class="material-symbols-outlined">
                            cancel
                        </span>

                        Deny Loan Application

                    </button>


                    <button class="extension-button">

                        <span class="material-symbols-outlined">
                            event_available
                        </span>

                        Approve Extension Request

                    </button>

                </aside>

            </div>





    </main>

</div>

</body>
</html>