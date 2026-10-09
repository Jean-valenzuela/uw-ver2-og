<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Applications | Utang Wise</title>

    <!-- APPLICATIONS CSS -->
    <link rel="stylesheet" href="../css/applications.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" href="../css/datatables.min.css">

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

            <a href="#" class="menu-item">
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


            <a href="#" class="menu-item">

                <span class="material-symbols-outlined">
                    logout
                </span>

                Log Out

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
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="top-search">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search application, applicant name, or ID..."
                >

            </div>


            <div class="admin-area">

                <div class="notification-icon">

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
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">
                        Dashboard
                        <span>›</span>
                        Applications
                    </div>

                    <h1>
                        Loan Applications
                    </h1>

                    <p>
                        Review and manage submitted loan applications.
                    </p>

                </div>

            </div>


            <!-- ==================================================
                 SUMMARY CARDS
            =================================================== -->
            <section class="summary-grid">

                <div class="summary-card">

                    <div class="summary-icon blue">

                        <span class="material-symbols-outlined">
                            description
                        </span>

                    </div>

                    <div>

                        <span class="summary-label">
                            Total Applications
                        </span>

                        <strong>
                            12
                        </strong>

                        <small>
                            All submitted applications
                        </small>

                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon orange">

                        <span class="material-symbols-outlined">
                            schedule
                        </span>

                    </div>

                    <div>

                        <span class="summary-label">
                            Pending Review
                        </span>

                        <strong>
                            3
                        </strong>

                        <small>
                            Awaiting admin review
                        </small>

                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon green">

                        <span class="material-symbols-outlined">
                            check_circle
                        </span>

                    </div>

                    <div>

                        <span class="summary-label">
                            Approved
                        </span>

                        <strong>
                            7
                        </strong>

                        <small>
                            Approved applications
                        </small>

                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon red">

                        <span class="material-symbols-outlined">
                            cancel
                        </span>

                    </div>

                    <div>

                        <span class="summary-label">
                            Denied
                        </span>

                        <strong>
                            2
                        </strong>

                        <small>
                            Denied applications
                        </small>

                    </div>

                </div>

            </section>


            <!-- ==================================================
                 APPLICATION WORKSPACE
            =================================================== -->
            <div
                class="applications-workspace"
                id="applicationsWorkspace"
            >

                <!-- =============================================
                     TABLE SIDE
                ============================================== -->
                <section class="applications-table-card">

                    <!-- CUSTOM FILTERS -->
                    <div class="filter-bar">

                        <div class="applicant-search">

                            <span class="material-symbols-outlined">
                                search
                            </span>

                            <input
                                type="text"
                                id="applicantSearch"
                                placeholder="Search applicant name or application ID..."
                            >

                        </div>


                        <select id="statusFilter">

                            <option value="">
                                All Status
                            </option>

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Approved">
                                Approved
                            </option>

                            <option value="Denied">
                                Denied
                            </option>

                        </select>


                        <select id="termFilter">

                            <option value="">
                                All Terms
                            </option>

                            <option value="1 Month">
                                1 Month
                            </option>

                            <option value="3 Months">
                                3 Months
                            </option>

                            <option value="6 Months">
                                6 Months
                            </option>

                            <option value="9 Months">
                                9 Months
                            </option>

                            <option value="12 Months">
                                12 Months
                            </option>

                        </select>


                        <button
                            type="button"
                            class="reset-btn"
                            id="resetFilters"
                        >

                            <span class="material-symbols-outlined">
                                refresh
                            </span>

                            Reset

                        </button>

                    </div>


                    <!-- DATATABLE -->
                    <div class="table-wrapper">

                        <table id="applicationsTable">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Applicant</th>
                                    <th>Application ID</th>
                                    <th>Date Applied</th>
                                    <th>Loan Amount</th>
                                    <th>Purpose</th>
                                    <th>Term</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                            </thead>


                            <tbody>

                                <!-- =====================================
                                     APPLICATION 1
                                ====================================== -->
                                <tr>

                                    <td>1</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar blue-avatar">
                                                MS
                                            </div>

                                            <div>
                                                <strong>
                                                    Maria Santos
                                                </strong>

                                                <span>
                                                    +63 915 123 4567
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-001</td>

                                    <td data-order="2026-09-28">
                                        Sep 28, 2026
                                    </td>

                                    <td class="money">
                                        ₱3,000
                                    </td>

                                    <td>
                                        Medical / Emergency
                                    </td>

                                    <td>
                                        3 Months
                                    </td>

                                    <td>

                                        <span class="status pending-status">
                                            Pending
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="maria"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- =====================================
                                     APPLICATION 2
                                ====================================== -->
                                <tr>

                                    <td>2</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar orange-avatar">
                                                JD
                                            </div>

                                            <div>
                                                <strong>
                                                    Juan Dela Cruz
                                                </strong>

                                                <span>
                                                    +63 912 345 6789
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-002</td>

                                    <td data-order="2026-09-27">
                                        Sep 27, 2026
                                    </td>

                                    <td class="money">
                                        ₱2,500
                                    </td>

                                    <td>
                                        Bills / Utilities
                                    </td>

                                    <td>
                                        3 Months
                                    </td>

                                    <td>

                                        <span class="status approved-status">
                                            Approved
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="juan"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- =====================================
                                     APPLICATION 3
                                ====================================== -->
                                <tr>

                                    <td>3</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar purple-avatar">
                                                AC
                                            </div>

                                            <div>
                                                <strong>
                                                    Ana Cruz
                                                </strong>

                                                <span>
                                                    +63 918 567 8901
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-003</td>

                                    <td data-order="2026-09-26">
                                        Sep 26, 2026
                                    </td>

                                    <td class="money">
                                        ₱3,000
                                    </td>

                                    <td>
                                        Education
                                    </td>

                                    <td>
                                        6 Months
                                    </td>

                                    <td>

                                        <span class="status pending-status">
                                            Pending
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="ana"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- =====================================
                                     APPLICATION 4
                                ====================================== -->
                                <tr>

                                    <td>4</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar green-avatar">
                                                PR
                                            </div>

                                            <div>
                                                <strong>
                                                    Pedro Reyes
                                                </strong>

                                                <span>
                                                    +63 917 456 7890
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-004</td>

                                    <td data-order="2026-09-25">
                                        Sep 25, 2026
                                    </td>

                                    <td class="money">
                                        ₱2,000
                                    </td>

                                    <td>
                                        Personal Needs
                                    </td>

                                    <td>
                                        1 Month
                                    </td>

                                    <td>

                                        <span class="status denied-status">
                                            Denied
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="pedro"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- =====================================
                                     APPLICATION 5
                                ====================================== -->
                                <tr>

                                    <td>5</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar gray-avatar">
                                                MR
                                            </div>

                                            <div>
                                                <strong>
                                                    Mark Rivera
                                                </strong>

                                                <span>
                                                    +63 915 222 3456
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-005</td>

                                    <td data-order="2026-09-24">
                                        Sep 24, 2026
                                    </td>

                                    <td class="money">
                                        ₱3,000
                                    </td>

                                    <td>
                                        Business
                                    </td>

                                    <td>
                                        6 Months
                                    </td>

                                    <td>

                                        <span class="status pending-status">
                                            Pending
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="mark"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- APPLICATION 6 -->
                                <tr>

                                    <td>6</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar purple-avatar">
                                                LM
                                            </div>

                                            <div>
                                                <strong>
                                                    Liza Mendoza
                                                </strong>

                                                <span>
                                                    +63 917 888 1234
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-006</td>

                                    <td data-order="2026-09-23">
                                        Sep 23, 2026
                                    </td>

                                    <td class="money">
                                        ₱2,500
                                    </td>

                                    <td>
                                        Home Expenses
                                    </td>

                                    <td>
                                        3 Months
                                    </td>

                                    <td>

                                        <span class="status approved-status">
                                            Approved
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="liza"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- APPLICATION 7 -->
                                <tr>

                                    <td>7</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar blue-avatar">
                                                CR
                                            </div>

                                            <div>
                                                <strong>
                                                    Carlo Ramirez
                                                </strong>

                                                <span>
                                                    +63 919 333 4455
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-007</td>

                                    <td data-order="2026-09-22">
                                        Sep 22, 2026
                                    </td>

                                    <td class="money">
                                        ₱3,000
                                    </td>

                                    <td>
                                        Medical / Emergency
                                    </td>

                                    <td>
                                        6 Months
                                    </td>

                                    <td>

                                        <span class="status approved-status">
                                            Approved
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="carlo"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- APPLICATION 8 -->
                                <tr>

                                    <td>8</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar orange-avatar">
                                                RF
                                            </div>

                                            <div>
                                                <strong>
                                                    Rhea Flores
                                                </strong>

                                                <span>
                                                    +63 920 111 2233
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-008</td>

                                    <td data-order="2026-09-21">
                                        Sep 21, 2026
                                    </td>

                                    <td class="money">
                                        ₱2,000
                                    </td>

                                    <td>
                                        Bills / Utilities
                                    </td>

                                    <td>
                                        1 Month
                                    </td>

                                    <td>

                                        <span class="status denied-status">
                                            Denied
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="rhea"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- APPLICATION 9 -->
                                <tr>

                                    <td>9</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar green-avatar">
                                                DG
                                            </div>

                                            <div>
                                                <strong>
                                                    Daniel Garcia
                                                </strong>

                                                <span>
                                                    +63 918 444 6677
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-009</td>

                                    <td data-order="2026-09-20">
                                        Sep 20, 2026
                                    </td>

                                    <td class="money">
                                        ₱3,000
                                    </td>

                                    <td>
                                        Education
                                    </td>

                                    <td>
                                        3 Months
                                    </td>

                                    <td>

                                        <span class="status approved-status">
                                            Approved
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="daniel"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>


                                <!-- APPLICATION 10 -->
                                <tr>

                                    <td>10</td>

                                    <td>

                                        <div class="applicant-name">

                                            <div class="small-avatar orange-avatar">
                                                KV
                                            </div>

                                            <div>
                                                <strong>
                                                    Katrina Villanueva
                                                </strong>

                                                <span>
                                                    +63 927 555 8899
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>APP-2026-010</td>

                                    <td data-order="2026-09-19">
                                        Sep 19, 2026
                                    </td>

                                    <td class="money">
                                        ₱2,500
                                    </td>

                                    <td>
                                        Personal Needs
                                    </td>

                                    <td>
                                        3 Months
                                    </td>

                                    <td>

                                        <span class="status approved-status">
                                            Approved
                                        </span>

                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="view-application-btn"
                                            data-applicant="katrina"
                                        >

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            View

                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </section>


                <!-- =============================================
                     APPLICANT DETAILS DRAWER

                     IMPORTANT:
                     Hidden by default.
                     JS adds .drawer-open to workspace
                     after View is clicked.
                ============================================== -->
                <aside
                    class="applicant-drawer"
                    id="applicantDrawer"
                    aria-hidden="true"
                >

                    <!-- DRAWER HEADER -->
                    <div class="drawer-header">

                        <div>

                            <span class="drawer-eyebrow">
                                Application Details
                            </span>

                            <h2 id="drawerApplicantName">
                                Maria Santos
                            </h2>

                            <p id="drawerApplicationId">
                                APP-2026-001
                            </p>

                        </div>


                        <button
                            type="button"
                            class="drawer-close"
                            id="closeDrawer"
                            aria-label="Close applicant details"
                        >

                            <span class="material-symbols-outlined">
                                close
                            </span>

                        </button>

                    </div>


                    <!-- APPLICANT SUMMARY -->
                    <div class="drawer-profile">

                        <div
                            class="drawer-avatar"
                            id="drawerAvatar"
                        >
                            MS
                        </div>

                        <div>

                            <strong id="drawerProfileName">
                                Maria Santos
                            </strong>

                            <span id="drawerPhone">
                                +63 915 123 4567
                            </span>

                        </div>


                        <span
                            class="status pending-status"
                            id="drawerStatus"
                        >
                            Pending
                        </span>

                    </div>


                    <!-- DRAWER TABS -->
                    <div class="drawer-tabs">

                        <button
                            type="button"
                            class="drawer-tab active"
                            data-tab="personal"
                        >
                            Personal
                        </button>

                        <button
                            type="button"
                            class="drawer-tab"
                            data-tab="financial"
                        >
                            Financial
                        </button>

                        <button
                            type="button"
                            class="drawer-tab"
                            data-tab="documents"
                        >
                            Documents
                        </button>

                        <button
                            type="button"
                            class="drawer-tab"
                            data-tab="reference"
                        >
                            Reference
                        </button>

                        <button
                            type="button"
                            class="drawer-tab"
                            data-tab="agreement"
                        >
                            Agreement
                        </button>

                    </div>


                    <!-- DRAWER BODY -->
                    <div class="drawer-body">

                        <!-- =====================================
                             PERSONAL
                        ====================================== -->
                        <section
                            class="drawer-panel active"
                            data-panel="personal"
                        >

                            <div class="drawer-section-heading">

                                <span class="material-symbols-outlined">
                                    person
                                </span>

                                <div>
                                    <strong>
                                        Personal Information
                                    </strong>

                                    <span>
                                        Applicant's submitted details
                                    </span>
                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span>Full Name</span>
                                    <strong id="detailFullName">
                                        Maria Santos
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Age</span>
                                    <strong>29 years old</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Phone Number</span>
                                    <strong id="detailPhone">
                                        +63 915 123 4567
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Email Address</span>
                                    <strong>
                                        maria.santos@email.com
                                    </strong>
                                </div>

                                <div class="detail-item full">
                                    <span>Home Address</span>
                                    <strong>
                                        Sariaya, Quezon
                                    </strong>
                                </div>

                            </div>


                            <div class="drawer-section-heading section-gap">

                                <span class="material-symbols-outlined">
                                    payments
                                </span>

                                <div>
                                    <strong>
                                        Loan Information
                                    </strong>

                                    <span>
                                        Requested loan details
                                    </span>
                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span>Loan Amount</span>
                                    <strong
                                        class="gold-text"
                                        id="detailLoanAmount"
                                    >
                                        ₱3,000
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Repayment</span>
                                    <strong id="detailTerm">
                                        3 Months
                                    </strong>
                                </div>

                                <div class="detail-item full">
                                    <span>Loan Purpose</span>
                                    <strong id="detailPurpose">
                                        Medical / Emergency
                                    </strong>
                                </div>

                                <div class="detail-item full">
                                    <span>Additional Details</span>
                                    <strong>
                                        For emergency medical expenses
                                        and prescribed medication.
                                    </strong>
                                </div>

                            </div>

                        </section>


                        <!-- =====================================
                             FINANCIAL
                        ====================================== -->
                        <section
                            class="drawer-panel"
                            data-panel="financial"
                        >

                            <div class="drawer-section-heading">

                                <span class="material-symbols-outlined">
                                    account_balance_wallet
                                </span>

                                <div>
                                    <strong>
                                        Financial Information
                                    </strong>

                                    <span>
                                        Income and employment details
                                    </span>
                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span>Employment Status</span>
                                    <strong>
                                        Employed
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Occupation</span>
                                    <strong>
                                        Administrative Staff
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Employer</span>
                                    <strong>
                                        ABC Trading
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Monthly Income</span>
                                    <strong>
                                        ₱18,000
                                    </strong>
                                </div>

                                <div class="detail-item full">
                                    <span>Other Income</span>
                                    <strong>
                                        None declared
                                    </strong>
                                </div>

                            </div>


                            <div class="document-row section-gap">

                                <div class="document-icon">

                                    <span class="material-symbols-outlined">
                                        description
                                    </span>

                                </div>

                                <div class="document-info">

                                    <strong>
                                        Certificate of Employment
                                    </strong>

                                    <span>
                                        COE_Maria_Santos.pdf
                                    </span>

                                </div>

                                <button
                                    type="button"
                                    class="document-view-btn"
                                >
                                    View
                                </button>

                            </div>

                        </section>


                        <!-- =====================================
                             DOCUMENTS
                        ====================================== -->
                        <section
                            class="drawer-panel"
                            data-panel="documents"
                        >

                            <div class="drawer-section-heading">

                                <span class="material-symbols-outlined">
                                    folder
                                </span>

                                <div>
                                    <strong>
                                        Supporting Documents
                                    </strong>

                                    <span>
                                        Identity and verification files
                                    </span>
                                </div>

                            </div>


                            <div class="documents-list">

                                <div class="document-row">

                                    <div class="document-icon">

                                        <span class="material-symbols-outlined">
                                            badge
                                        </span>

                                    </div>

                                    <div class="document-info">

                                        <strong>
                                            Valid ID
                                        </strong>

                                        <span>
                                            national_id.jpg
                                        </span>

                                    </div>

                                    <button
                                        type="button"
                                        class="document-view-btn"
                                    >
                                        View
                                    </button>

                                </div>


                                <div class="document-row">

                                    <div class="document-icon">

                                        <span class="material-symbols-outlined">
                                            face
                                        </span>

                                    </div>

                                    <div class="document-info">

                                        <strong>
                                            Selfie with Valid ID
                                        </strong>

                                        <span>
                                            selfie_with_id.jpg
                                        </span>

                                    </div>

                                    <button
                                        type="button"
                                        class="document-view-btn"
                                    >
                                        View
                                    </button>

                                </div>


                                <div class="document-row">

                                    <div class="document-icon">

                                        <span class="material-symbols-outlined">
                                            description
                                        </span>

                                    </div>

                                    <div class="document-info">

                                        <strong>
                                            Certificate of Employment
                                        </strong>

                                        <span>
                                            COE_Maria_Santos.pdf
                                        </span>

                                    </div>

                                    <button
                                        type="button"
                                        class="document-view-btn"
                                    >
                                        View
                                    </button>

                                </div>

                            </div>

                        </section>


                        <!-- =====================================
                             REFERENCE PERSON
                        ====================================== -->
                        <section
                            class="drawer-panel"
                            data-panel="reference"
                        >

                            <div class="drawer-section-heading">

                                <span class="material-symbols-outlined">
                                    contact_phone
                                </span>

                                <div>
                                    <strong>
                                        Reference Person
                                    </strong>

                                    <span>
                                        Contact person for verification
                                    </span>
                                </div>

                            </div>


                            <div class="detail-grid">

                                <div class="detail-item">
                                    <span>Full Name</span>
                                    <strong>
                                        Juan Santos
                                    </strong>
                                </div>

                                <div class="detail-item">
                                    <span>Relationship</span>
                                    <strong>
                                        Brother
                                    </strong>
                                </div>

                                <div class="detail-item full">
                                    <span>Phone Number</span>
                                    <strong>
                                        +63 917 111 2233
                                    </strong>
                                </div>

                            </div>

                        </section>


                        <!-- =====================================
                             AGREEMENT
                        ====================================== -->
                        <section
                            class="drawer-panel"
                            data-panel="agreement"
                        >

                            <div class="drawer-section-heading">

                                <span class="material-symbols-outlined">
                                    contract
                                </span>

                                <div>
                                    <strong>
                                        Agreement & Kasulatan
                                    </strong>

                                    <span>
                                        Submitted repayment agreement
                                    </span>
                                </div>

                            </div>


                            <div class="document-row">

                                <div class="document-icon">

                                    <span class="material-symbols-outlined">
                                        description
                                    </span>

                                </div>

                                <div class="document-info">

                                    <strong>
                                        Kasulatan
                                    </strong>

                                    <span>
                                        kasulatan_maria_santos.pdf
                                    </span>

                                </div>

                                <button
                                    type="button"
                                    class="document-view-btn"
                                >
                                    View
                                </button>

                            </div>


                            <div class="agreement-check">

                                <span class="material-symbols-outlined">
                                    check_circle
                                </span>

                                <div>

                                    <strong>
                                        Agreement Accepted
                                    </strong>

                                    <span>
                                        Applicant confirmed the terms
                                        before submission.
                                    </span>

                                </div>

                            </div>

                        </section>


                        <!-- =====================================
                             ADMIN NOTES
                        ====================================== -->
                        <div class="admin-notes">

                            <label for="adminNotes">
                                Admin Notes
                            </label>

                            <textarea
                                id="adminNotes"
                                placeholder="Add notes about this application..."
                            ></textarea>

                        </div>

                    </div>


                    <!-- =========================================
                         ACTION BUTTONS
                    ========================================== -->
                    <div class="drawer-actions">

                        <button
                            type="button"
                            class="deny-btn"
                            id="denyApplication"
                        >

                            <span class="material-symbols-outlined">
                                close
                            </span>

                            Deny

                        </button>


                        <button
                            type="button"
                            class="more-info-btn"
                            id="requestMoreInfo"
                        >

                            <span class="material-symbols-outlined">
                                chat
                            </span>

                            Request Info

                        </button>


                        <button
                            type="button"
                            class="approve-btn"
                            id="approveApplication"
                        >

                            <span class="material-symbols-outlined">
                                check
                            </span>

                            Approve

                        </button>

                    </div>

                </aside>

            </div>

        </div>

    </main>

</div>


<!-- DATATABLES -->
<script src="../js/datatables.min.js"></script>


<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- APPLICATIONS JS -->
<script src="../js/applications.js"></script>

</body>
</html>