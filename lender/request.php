<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loan Application | Utang Wise</title>

    <link rel="stylesheet" href="../css/request.css">

    <!-- GOOGLE FONTS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL SYMBOLS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

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


        <nav class="sidebar-menu">

            <a href="dashboard.php" class="menu-item">

                <span class="material-symbols-outlined">
                    home
                </span>

                Dashboard

            </a>


            <a href="loaners.php" class="menu-item">

                <span class="material-symbols-outlined">
                    groups
                </span>

                Loaners

            </a>


            <a href="applications.php" class="menu-item active">

                <span class="material-symbols-outlined">
                    description
                </span>

                Applications

                <span class="menu-badge">
                    5
                </span>

            </a>


            <a href="extension-requests.php" class="menu-item">

                <span class="material-symbols-outlined">
                    schedule
                </span>

                Extension Requests

                <span class="menu-badge">
                    2
                </span>

            </a>


            <a href="debts-loans.php" class="menu-item">

                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>

                Debts / Loans

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    payments
                </span>

                Payments

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    bar_chart
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


        <nav class="sidebar-menu sidebar-bottom">

            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    settings
                </span>

                Settings

            </a>


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    help
                </span>

                Help & Support

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
                verified_user
            </span>

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
    <main class="main-content">


        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search applicant name, application ID, or phone number..."
                >

            </div>


            <div class="admin-area">

                <div class="notification">

                    <span class="material-symbols-outlined">
                        notifications
                    </span>

                    <span class="notification-dot"></span>

                </div>


                <div class="admin-avatar">

                    <span class="material-symbols-outlined">
                        person
                    </span>

                </div>


                <div class="admin-info">

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


        <!-- ==================================================
             PAGE CONTENT
        =================================================== -->
        <div class="page-content">


            <!-- PAGE HEADING -->
            <section class="page-heading">

                <div>

                    <div class="breadcrumb">

                        Applications

                        <span>›</span>

                        View Application

                    </div>


                    <div class="title-row">

                        <h1>
                            Loan Application
                        </h1>

                        <span class="pending-badge">
                            Pending Review
                        </span>

                    </div>


                    <p>
                        Application ID:
                        <strong>LA-2025-0001</strong>
                    </p>

                    <p>
                        Date Submitted:
                        July 10, 2025
                        <span>•</span>
                        10:24 AM
                    </p>

                </div>


                <div class="heading-right">

                    <a href="applications-list.php" class="back-btn">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to Applications

                    </a>


                    <div class="application-navigation">

                        <button>
                            <span class="material-symbols-outlined">
                                chevron_left
                            </span>
                        </button>

                        <strong>
                            1 of 5
                        </strong>

                        <button>
                            <span class="material-symbols-outlined">
                                chevron_right
                            </span>
                        </button>

                    </div>

                </div>

            </section>


            <!-- ==================================================
                 APPLICANT SUMMARY
            =================================================== -->
            <section class="applicant-summary">


                <div class="applicant-profile">

                    <div class="applicant-avatar">
                        JD
                    </div>


                    <div class="applicant-contact">

                        <h2>
                            Juan Dela Cruz
                        </h2>


                        <div>

                            <span class="material-symbols-outlined">
                                phone
                            </span>

                            +63 912 345 6789

                        </div>


                        <div>

                            <span class="material-symbols-outlined">
                                mail
                            </span>

                            juan@email.com

                        </div>


                        <div>

                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            123 Mabini St., Manila

                        </div>

                    </div>

                </div>


                <div class="applicant-quick-info">

                    <div>

                        <span class="material-symbols-outlined">
                            badge
                        </span>

                        <strong>
                            28 years old
                        </strong>

                        <span class="eligible">
                            Eligible
                        </span>

                    </div>


                    <div>

                        <span class="material-symbols-outlined">
                            work
                        </span>

                        <strong>
                            Office Staff
                        </strong>

                    </div>


                    <div>

                        <span class="material-symbols-outlined">
                            payments
                        </span>

                        <strong>
                            ₱25,000 / month
                        </strong>

                    </div>


                    <div>

                        <span class="material-symbols-outlined">
                            groups
                        </span>

                        <strong>
                            Single
                        </strong>

                    </div>

                </div>


                <div class="requested-loan">

                    <div class="section-mini-title">

                        <span class="material-symbols-outlined">
                            request_quote
                        </span>

                        Requested Loan

                    </div>


                    <span>
                        Requested Amount
                    </span>

                    <strong class="requested-amount">
                        ₱3,000
                    </strong>

                    <small>
                        Starting loan – Max of 3k
                    </small>


                    <div class="requested-row">

                        <span>
                            Type of Loan
                        </span>

                        <strong class="loan-type">
                            Money
                        </strong>

                    </div>


                    <div class="requested-row">

                        <span>
                            Purpose
                        </span>

                        <strong>
                            Emergency Expense
                        </strong>

                    </div>

                </div>

            </section>


            <!-- ==================================================
                 DETAILS GRID
            =================================================== -->
            <section class="application-grid">


                <!-- PERSONAL INFORMATION -->
                <div class="application-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon">
                                person
                            </span>

                            <h3>
                                Personal Information
                            </h3>

                        </div>


                        <button class="edit-btn">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="info-row">
                        <span>Full Name</span>
                        <strong>Juan Dela Cruz</strong>
                    </div>

                    <div class="info-row">
                        <span>Age</span>
                        <strong>28 years old</strong>
                    </div>

                    <div class="info-row">
                        <span>Date of Birth</span>
                        <strong>May 14, 1997</strong>
                    </div>

                    <div class="info-row">
                        <span>Address</span>
                        <strong>123 Mabini St., Manila</strong>
                    </div>

                    <div class="info-row">
                        <span>Occupation</span>
                        <strong>Office Staff</strong>
                    </div>

                    <div class="info-row">
                        <span>Civil Status</span>
                        <strong>Single</strong>
                    </div>

                </div>


                <!-- FINANCIAL INFORMATION -->
                <div class="application-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon">
                                account_balance_wallet
                            </span>

                            <h3>
                                Financial Information
                            </h3>

                        </div>


                        <button class="edit-btn">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="info-row">
                        <span>Source of Income</span>
                        <strong>Employment</strong>
                    </div>

                    <div class="info-row">
                        <span>Occupation</span>
                        <strong>Office Staff</strong>
                    </div>

                    <div class="info-row">
                        <span>Monthly Income</span>
                        <strong>₱25,000</strong>
                    </div>

                    <div class="info-row">
                        <span>Other Income (if any)</span>
                        <strong>None</strong>
                    </div>

                    <div class="info-row">
                        <span>Existing Loans</span>
                        <strong>None</strong>
                    </div>

                </div>


                <!-- DOCUMENTS -->
                <div class="application-card documents-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon blue-icon">
                                description
                            </span>

                            <h3>
                                Documents
                            </h3>

                        </div>

                    </div>


                    <div class="document-images">

                        <div class="document-preview">

                            <div class="image-placeholder id-placeholder">

                                <span class="material-symbols-outlined">
                                    badge
                                </span>

                                <span>
                                    Valid ID
                                </span>

                            </div>


                            <div class="document-bottom">

                                <span>
                                    Valid ID (Front)
                                </span>

                                <button>
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>

                                    View
                                </button>

                            </div>

                        </div>


                        <div class="document-preview">

                            <div class="image-placeholder selfie-placeholder">

                                <span class="material-symbols-outlined">
                                    person
                                </span>

                                <span>
                                    Selfie with ID
                                </span>

                            </div>


                            <div class="document-bottom">

                                <span>
                                    Selfie with Valid ID
                                </span>

                                <button>
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>

                                    View
                                </button>

                            </div>

                        </div>

                    </div>


                    <div class="file-row">

                        <div>

                            <span class="material-symbols-outlined pdf-icon">
                                picture_as_pdf
                            </span>

                            <div>

                                <strong>
                                    Proof of Billing (if any)
                                </strong>

                                <span>
                                    billing-proof.pdf (245 KB)
                                </span>

                            </div>

                        </div>


                        <button class="download-btn">

                            <span class="material-symbols-outlined">
                                download
                            </span>

                            Download

                        </button>

                    </div>

                </div>


                <!-- LOAN DETAILS -->
                <div class="application-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon">
                                inventory_2
                            </span>

                            <h3>
                                Loan Details
                            </h3>

                        </div>


                        <button class="edit-btn">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="info-row">

                        <span>
                            Type of Loan
                        </span>

                        <strong class="loan-type">
                            Money
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>
                            Requested Amount
                        </span>

                        <strong>
                            ₱3,000
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>
                            Purpose
                        </span>

                        <strong>
                            Emergency Expense
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>
                            Preferred Repayment Date
                        </span>

                        <strong>
                            Aug 10, 2025

                            <small>
                                1 month after approval
                            </small>

                        </strong>

                    </div>

                </div>


                <!-- LEGAL AGREEMENT -->
                <div class="application-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon">
                                contract
                            </span>

                            <h3>
                                Legal Agreement
                            </h3>

                        </div>


                        <button class="edit-btn">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="info-row">

                        <span>
                            Interest Rate
                        </span>

                        <strong>
                            5% per month
                        </strong>

                    </div>


                    <div class="agreement-file">

                        <span class="material-symbols-outlined pdf-icon">
                            picture_as_pdf
                        </span>


                        <div>

                            <span>
                                Agreement File
                            </span>

                            <strong>
                                Kasulatan.pdf
                            </strong>

                            <small>
                                320 KB
                            </small>

                        </div>


                        <button class="view-btn">
                            View
                        </button>

                    </div>


                    <div class="agreement-file">

                        <span class="material-symbols-outlined upload-ok">
                            check_circle
                        </span>


                        <div>

                            <span>
                                Signed Agreement
                            </span>

                            <strong>
                                Uploaded
                            </strong>

                            <small>
                                signed_agreement.pdf
                            </small>

                        </div>


                        <button class="view-btn">
                            View
                        </button>

                    </div>

                </div>


                <!-- REFERENCE PERSON -->
                <div class="application-card">

                    <div class="card-heading">

                        <div>

                            <span class="material-symbols-outlined card-icon">
                                groups
                            </span>

                            <h3>
                                Reference Person
                            </h3>

                        </div>


                        <button class="edit-btn">

                            <span class="material-symbols-outlined">
                                edit
                            </span>

                            Edit

                        </button>

                    </div>


                    <div class="info-row">
                        <span>Name</span>
                        <strong>Maria Santos</strong>
                    </div>

                    <div class="info-row">
                        <span>Relationship</span>
                        <strong>Sister</strong>
                    </div>

                    <div class="info-row">
                        <span>Phone Number</span>
                        <strong>+63 915 123 4567</strong>
                    </div>

                    <div class="info-row">
                        <span>Address</span>
                        <strong>Quezon City</strong>
                    </div>

                </div>

            </section>


            <!-- ==================================================
                 BOTTOM AREA
            =================================================== -->
            <section class="application-bottom">


                <!-- VERIFICATION -->
                <div class="verification-box">

                    <div class="verification-icon">

                        <span class="material-symbols-outlined">
                            call
                        </span>

                    </div>


                    <div class="verification-text">

                        <strong>
                            Verification Required
                        </strong>

                        <p>
                            Call the applicant and reference person
                            to verify the information provided.
                        </p>

                    </div>


                    <div class="verification-actions">

                        <button>

                            <span class="material-symbols-outlined">
                                call
                            </span>

                            Call Applicant

                        </button>


                        <button>

                            <span class="material-symbols-outlined">
                                call
                            </span>

                            Call Reference

                        </button>

                    </div>

                </div>


                <!-- ADMIN NOTES -->
                <div class="admin-notes">

                    <label>
                        Admin Notes
                        <span>(Optional)</span>
                    </label>

                    <textarea
                        placeholder="Add notes about this application..."
                    ></textarea>

                </div>


                <!-- ACTION BUTTONS -->
                <div class="application-actions">

                    <button class="approve-btn">

                        <span class="material-symbols-outlined">
                            check_circle
                        </span>

                        Approve Application

                    </button>


                    <button class="deny-btn">

                        <span class="material-symbols-outlined">
                            cancel
                        </span>

                        Deny Application

                    </button>

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>