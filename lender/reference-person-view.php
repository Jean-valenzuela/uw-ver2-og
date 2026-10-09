<?php require_once __DIR__.'/../helpers/lending.php'; $lenderAccount=lender_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reference Person | Utang Wise</title>

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

    <!-- =========================================
         SIDEBAR
    ========================================== -->
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
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners.php" class="menu-item active">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">description</span>
                Applications
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">schedule</span>
                Extension Requests
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>
                Debts / Loans
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">payments</span>
                Payments
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">bar_chart</span>
                Reports
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">contract</span>
                Legal Agreements
            </a>

        </nav>


        <div class="sidebar-divider"></div>


        <nav class="sidebar-menu bottom-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">settings</span>
                Settings
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">support_agent</span>
                Help & Support
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">logout</span>
                Log Out
            </a>

        </nav>


        <div class="security-box">

            <span class="material-symbols-outlined">
                lock
            </span>

            <div>
                <h4>Secure & Trusted</h4>

                <p>
                    Client information is protected
                    and handled securely.
                </p>
            </div>

        </div>

    </aside>


    <!-- =========================================
         MAIN
    ========================================== -->
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
                    <strong>Admin</strong>
                    <span>Loan Officer</span>
                </div>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>

        </header>


        <!-- =========================================
             PAGE CONTENT
        ========================================== -->
        <div class="page-content">


            <!-- HEADING -->
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">
                        Loaners
                        <span>›</span>
                        Juan Dela Cruz
                        <span>›</span>
                        Reference Person
                    </div>

                    <h1>
                        Client Profile
                    </h1>

                    <p>
                        View and manage client information,
                        loans, and documents.
                    </p>

                </div>

            </div>


            <!-- =========================================
                 TABS
            ========================================== -->
            <div class="tabs">

                <a href="loaners.php" class="tab">

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


                <a
                    href="reference-person-admin.php"
                    class="tab active"
                >

                    <span class="material-symbols-outlined">
                        groups
                    </span>

                    Reference Person

                </a>

            </div>


            <!-- =========================================
                 REFERENCE PERSON CARD
            ========================================== -->
            <section class="reference-admin-card">

                <div class="reference-admin-heading">

                    <div class="reference-admin-title">

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                        <div>

                            <h2>
                                Reference Person
                            </h2>

                            <p>
                                View the trusted contact person
                                provided by the client.
                            </p>

                        </div>

                    </div>


                    <button class="edit-reference-button">

                        <span class="material-symbols-outlined">
                            edit
                        </span>

                        Edit Reference

                    </button>

                </div>


                <!-- =========================================
                     PROFILE SUMMARY
                ========================================== -->
                <div class="reference-profile">

                    <div class="reference-avatar">

                        <span class="material-symbols-outlined">
                            person
                        </span>

                    </div>


                    <div class="reference-main-info">

                        <span class="reference-label">
                            Primary Reference
                        </span>

                        <h2>
                            Maria Santos
                        </h2>

                        <p>
                            Sister of Juan Dela Cruz
                        </p>

                    </div>


                    <div class="reference-status">

                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        <div>

                            <small>
                                Reference Status
                            </small>

                            <strong>
                                Active
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     CONTACT INFORMATION
                ========================================== -->
                <div class="reference-section">

                    <div class="reference-section-title">

                        <span class="material-symbols-outlined">
                            contact_phone
                        </span>

                        <h3>
                            Contact Information
                        </h3>

                    </div>


                    <div class="reference-info-grid">


                        <div class="reference-info-box">

                            <span>
                                Full Name
                            </span>

                            <strong>
                                Maria Santos
                            </strong>

                        </div>


                        <div class="reference-info-box">

                            <span>
                                Relationship
                            </span>

                            <strong>
                                Sister
                            </strong>

                        </div>


                        <div class="reference-info-box">

                            <span>
                                Mobile Number
                            </span>

                            <strong>
                                +63 915 123 4567
                            </strong>

                        </div>


                        <div class="reference-info-box">

                            <span>
                                Email Address
                            </span>

                            <strong>
                                maria@email.com
                            </strong>

                        </div>


                        <div class="reference-info-box">

                            <span>
                                Occupation
                            </span>

                            <strong>
                                Administrative Staff
                            </strong>

                        </div>


                        <div class="reference-info-box">

                            <span>
                                Company / Organization
                            </span>

                            <strong>
                                XYZ Corporation
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     ADDRESS
                ========================================== -->
                <div class="reference-section">

                    <div class="reference-section-title">

                        <span class="material-symbols-outlined">
                            location_on
                        </span>

                        <h3>
                            Address
                        </h3>

                    </div>


                    <div class="reference-address">

                        <div>

                            <span>
                                House No. / Street
                            </span>

                            <strong>
                                45 Rizal Street
                            </strong>

                        </div>


                        <div>

                            <span>
                                Barangay
                            </span>

                            <strong>
                                Barangay Central
                            </strong>

                        </div>


                        <div>

                            <span>
                                City / Municipality
                            </span>

                            <strong>
                                Quezon City
                            </strong>

                        </div>


                        <div>

                            <span>
                                Province
                            </span>

                            <strong>
                                Metro Manila
                            </strong>

                        </div>


                        <div>

                            <span>
                                ZIP Code
                            </span>

                            <strong>
                                1100
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     REFERENCE RELATION
                ========================================== -->
                <div class="reference-bottom-grid">


                    <!-- RELATION DETAILS -->
                    <div class="reference-note-card">

                        <div class="reference-note-heading">

                            <span class="material-symbols-outlined">
                                handshake
                            </span>

                            <h3>
                                Reference Details
                            </h3>

                        </div>


                        <div class="reference-detail-row">

                            <span>
                                Relationship to Client
                            </span>

                            <strong>
                                Sister
                            </strong>

                        </div>


                        <div class="reference-detail-row">

                            <span>
                                Years Known
                            </span>

                            <strong>
                                28 Years
                            </strong>

                        </div>


                        <div class="reference-detail-row">

                            <span>
                                Preferred Contact
                            </span>

                            <strong>
                                Mobile Call
                            </strong>

                        </div>

                    </div>


                    <!-- NOTES -->
                    <div class="reference-note-card">

                        <div class="reference-note-heading">

                            <span class="material-symbols-outlined">
                                sticky_note_2
                            </span>

                            <h3>
                                Notes
                            </h3>

                        </div>


                        <p class="reference-note-text">
                            Client listed Maria Santos as a trusted
                            reference person who may be contacted
                            if additional confirmation is required
                            during the loan process.
                        </p>

                    </div>


                    <!-- VERIFICATION -->
                    <div class="reference-verification-card">

                        <div class="reference-verification-icon">

                            <span class="material-symbols-outlined">
                                verified_user
                            </span>

                        </div>


                        <div>

                            <span>
                                Contact Verification
                            </span>

                            <h3>
                                Available for Contact
                            </h3>

                            <p>
                                Reference details have been
                                provided by the client.
                            </p>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>