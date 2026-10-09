<?php

/*
|--------------------------------------------------------------------------
| TEMPORARY APPLICANT STATUS
|--------------------------------------------------------------------------
| true  = New applicant → Maximum ₱3,000
| false = Existing applicant → Flexible amount
|
| Later kukunin natin ito automatically sa database.
|--------------------------------------------------------------------------
*/

$isNewApplicant = true;


/*
|--------------------------------------------------------------------------
| FORM SUBMISSION
|--------------------------------------------------------------------------
*/

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $amount = isset($_POST["amount"])
        ? (float) $_POST["amount"]
        : 0;

    $loanPurpose = $_POST["loan_purpose"] ?? "";
$purposeDetails = trim($_POST["purpose_details"] ?? "");

$repaymentSchedule = $_POST["repayment_schedule"] ?? "";


    if ($amount <= 0) {

        $message = "Please enter a valid loan amount.";

    } elseif ($isNewApplicant && $amount > 3000) {

        $message = "New applicants may request up to ₱3,000 only.";

    } elseif (empty($loanPurpose)) {

        $message = "Please select your loan purpose.";

    } elseif (
        !isset($_FILES["kasulatan"]) ||
        $_FILES["kasulatan"]["error"] !== UPLOAD_ERR_OK
    ) {

        $message = "Please upload your kasulatan na nangangako.";

    } elseif (empty($repaymentSchedule)) {

        $message = "Please select your preferred repayment schedule.";

    } else {

        /*
        |--------------------------------------------------------------------------
        | DATABASE INSERT LATER
        |--------------------------------------------------------------------------
        |
        | Dito natin later ise-save:
        |
        | borrower_id
        | amount
        | kasulatan
        | repayment_schedule
        | status = pending
        | date_requested
        |
        |--------------------------------------------------------------------------
        */

        $message = "Your loan request has been submitted.";

    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Request Loan | Utang Wise
    </title>


    <!-- CSS -->
    <link
        rel="stylesheet"
        href="css/request-loan.css"
    >


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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>


<div class="client-layout">


    <!-- ============================================================
         CLIENT SIDEBAR
    ============================================================= -->

    <aside class="sidebar">


        <!-- BRAND -->
        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>


            <div class="brand-text">

                <h2>
                    UTANG WISE
                </h2>

                <span>
                    LENDING MADE SIMPLE
                </span>

            </div>

        </div>



        <!-- MAIN MENU -->
        <nav class="sidebar-menu">


            <a
                href="client-dashboard.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    home
                </span>

                Dashboard

            </a>



            <a
                href="profile.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    person
                </span>

                Profile

            </a>



            <a
                href="my-loans.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    description
                </span>

                My Loans

            </a>



            <a
                href="request-loan.php"
                class="menu-item active"
            >

                <span class="material-symbols-outlined">
                    add_circle
                </span>

                Request Loan

            </a>

              <a
                href="payments.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    credit_card
                </span>

                Payments

            </a>



            <a
                href="payment-extension.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    calendar_month
                </span>

                Payment Extension

            </a>



          



            <a
                href="payment-history.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    history
                </span>

                Payment History

            </a>



            <a
                href="agreements.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    contract
                </span>

                Agreements

            </a>

        </nav>



        <!-- DIVIDER -->
        <div class="sidebar-divider"></div>



        <!-- BOTTOM -->
        <nav class="sidebar-menu bottom-menu">


            <a
                href="logout.php"
                class="menu-item"
            >

                <span class="material-symbols-outlined">
                    logout
                </span>

                Log Out

            </a>

        </nav>


    </aside>



    <!-- ============================================================
         MAIN
    ============================================================= -->

    <main class="main-content">


        <!-- TOPBAR -->
        <header class="topbar">

        <button
    type="button"
    class="mobile-menu-btn"
    id="mobileMenuBtn"
>
    <span class="material-symbols-outlined">
        menu
    </span>
        </button>


            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search..."
                >

            </div>



            <div class="user-area">


                <div class="notification">

                    <span class="material-symbols-outlined">
                        notifications
                    </span>

                    <span class="notification-dot"></span>

                </div>



                <div class="user-avatar">
                    JD
                </div>



                <strong>
                    Juan Dela Cruz
                </strong>



                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

            </div>


        </header>



        <!-- ========================================================
             PAGE
        ========================================================= -->

        <div class="page-content">


            <!-- BREADCRUMB -->
            <div class="breadcrumb">

                Home

                <span>›</span>

                Request Loan

            </div>



            <!-- TITLE -->
            <div class="page-heading">

                <h1>
                    Request a Loan
                </h1>

                <p>
                    Fill out the details below to create a loan request.
                </p>

            </div>



            <?php if (!empty($message)): ?>

                <div class="form-message">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>



            <!-- ====================================================
                 GRID
            ===================================================== -->

            <div class="request-grid">


                <!-- =================================================
                     LEFT
                ================================================== -->

                <form
                    id="loanRequestForm"
                    class="loan-form"
                    method="POST"
                    enctype="multipart/form-data"
                >


                    <!-- =============================================
                         PROGRESS STEPS
                    ============================================== -->

                    <div class="progress-steps">

                        <div class="progress-step active" data-progress="1">
                            <div class="progress-number">1</div>
                            <strong>Amount</strong>
                        </div>

                        <div class="progress-line"></div>

                        <div class="progress-step" data-progress="2">
                            <div class="progress-number">2</div>
                            <strong>Loan Purpose</strong>
                        </div>

                        <div class="progress-line"></div>

                        <div class="progress-step" data-progress="3">
                            <div class="progress-number">3</div>
                            <strong>Kasulatan</strong>
                        </div>

                        <div class="progress-line"></div>

                        <div class="progress-step" data-progress="4">
                            <div class="progress-number">4</div>
                            <strong>Repayment</strong>
                        </div>

                    </div>


                    <!-- =================================================
                         STEP 1 - AMOUNT
                    ================================================== -->

                    <section
                        class="form-step active"
                        data-step="1"
                    >


                        <div class="step-card">


                            <div class="section-number">
                                1
                            </div>


                            <div class="section-content">


                                <h2>
                                    Amount
                                </h2>


                                <p>
                                    Enter the amount you want to borrow.
                                </p>



                                <div class="amount-input">

                                    <span>
                                        ₱
                                    </span>


                                    <input
                                        id="loanAmount"
                                        type="number"
                                        name="amount"
                                        min="1"

                                        <?php if ($isNewApplicant): ?>
                                            max="3000"
                                        <?php endif; ?>

                                        placeholder="0.00"
                                        required
                                    >

                                </div>



                                <?php if ($isNewApplicant): ?>

                                    <!-- NEW APPLICANT -->
                                    <div class="applicant-notice new-applicant">

                                        <span class="material-symbols-outlined">
                                            info
                                        </span>


                                        <div>

                                            <strong>
                                                New Applicant
                                            </strong>

                                            <p>
                                                Your maximum loan amount is
                                                <b>₱3,000</b>.
                                            </p>

                                            <small>
                                                After successfully completing
                                                a loan, you may become eligible
                                                for higher loan amounts.
                                            </small>

                                        </div>

                                    </div>


                                <?php else: ?>

                                    <!-- EXISTING APPLICANT -->
                                    <div class="applicant-notice existing-applicant">

                                        <span class="material-symbols-outlined">
                                            check_circle
                                        </span>


                                        <div>

                                            <strong>
                                                Existing Applicant
                                            </strong>

                                            <p>
                                                Your requested amount is flexible
                                                based on your loan history.
                                            </p>

                                            <small>
                                                The final amount remains subject
                                                to lender approval.
                                            </small>

                                        </div>

                                    </div>

                                <?php endif; ?>


                            </div>

                        </div>


                    </section>



                    <!-- =================================================
                         STEP 2 - LOAN PURPOSE
                    ================================================== -->

                    <section class="form-step" data-step="2">

                        <div class="step-card">

                            <div class="section-number">
                                2
                            </div>

                            <div class="section-content">

                                <h2>Loan Purpose</h2>

                                <p>
                                    Tell us what you will use the loan for.
                                </p>

                                <div class="purpose-fields">

                                    <label for="loanPurpose">Loan Purpose</label>

                                    <select id="loanPurpose" name="loan_purpose" required>
                                        <option value="" selected disabled>Select a purpose</option>
                                        <option value="Medical / Emergency">Medical / Emergency</option>
                                        <option value="Education">Education</option>
                                        <option value="Bills / Utilities">Bills / Utilities</option>
                                        <option value="Business">Business</option>
                                        <option value="Personal Needs">Personal Needs</option>
                                        <option value="Home Expenses">Home Expenses</option>
                                        <option value="Other">Other</option>
                                    </select>

                                    <label for="purposeDetails" class="purpose-details-label">
                                        Additional Details <span>(Optional)</span>
                                    </label>

                                    <textarea
                                        id="purposeDetails"
                                        name="purpose_details"
                                        maxlength="300"
                                        placeholder="Briefly describe the purpose of your loan..."
                                    ></textarea>

                                    <div class="purpose-character-count">
                                        <span id="purposeCharacterCount">0</span>/300
                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>


                    <!-- =================================================
                         STEP 3 - KASULATAN
                    ================================================== -->

                    <section
                        class="form-step"
                        data-step="3"
                    >


                        <div class="step-card">


                            <div class="section-number">
                                3
                            </div>


                            <div class="section-content">


                                <h2>
                                    Kasulatan na Nangangako
                                </h2>


                                <p>
                                    Create and upload your letter of promise.
                                </p>



                                <div class="kasulatan-info">

                                    <span class="material-symbols-outlined">
                                        description
                                    </span>


                                    <div>

                                        <strong>
                                            Create Your Kasulatan
                                        </strong>

                                        <p>
                                            Write a letter stating your intention
                                            to repay the loan and your agreement
                                            to fulfill your payment responsibility.
                                        </p>

                                    </div>

                                </div>



                                <label class="upload-box">


                                    <span class="material-symbols-outlined upload-icon">
                                        cloud_upload
                                    </span>


                                    <strong>
                                        Upload Your Kasulatan
                                    </strong>


                                    <p id="fileNameText">
                                        Drag and drop your file here,
                                        or click to browse.
                                    </p>


                                    <small>
                                        PDF, JPG, JPEG or PNG
                                        • Maximum 5MB
                                    </small>


                                    <span class="choose-file-btn">
                                        Choose File
                                    </span>


                                    <input
                                        id="kasulatanFile"
                                        type="file"
                                        name="kasulatan"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                    >


                                </label>


                            </div>


                        </div>


                    </section>



                    <!-- =================================================
                         STEP 4 - REPAYMENT
                    ================================================== -->

                    <section
                        class="form-step"
                        data-step="4"
                    >


                        <div class="step-card">


                            <div class="section-number">
                                4
                            </div>


                            <div class="section-content">


                                <h2>
                                    Repayment Schedule Preference
                                </h2>


                                <p>
                                    Choose your preferred repayment period.
                                </p>



                                <div class="repayment-options">


                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="1_month"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                1 Month
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>



                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="3_months"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                3 Months
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>



                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="6_months"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                6 Months
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>



                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="9_months"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                9 Months
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>



                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="12_months"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                12 Months
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>



                                    <label class="repayment-option">

                                        <input
                                            type="radio"
                                            name="repayment_schedule"
                                            value="2_years"
                                        >

                                        <span class="radio-circle"></span>


                                        <div>

                                            <strong>
                                                2 Years
                                            </strong>

                                            <span>
                                                Monthly
                                            </span>

                                        </div>

                                    </label>


                                </div>


                            </div>


                        </div>


                    </section>



                    <!-- =================================================
                         NAVIGATION
                    ================================================== -->

                    <div class="form-actions">


                        <button
                            type="button"
                            id="backButton"
                            class="back-button"
                            hidden
                        >

                            <span class="material-symbols-outlined">
                                arrow_back
                            </span>

                            Back

                        </button>



                        <a
                            href="client-dashboard.php"
                            id="cancelButton"
                            class="cancel-button"
                        >
                            Cancel
                        </a>



                        <button
                            type="button"
                            id="nextButton"
                            class="next-button"
                        >

                            Next

                            <span class="material-symbols-outlined">
                                arrow_forward
                            </span>

                        </button>



                        <button
                            type="submit"
                            id="submitButton"
                            class="submit-button"
                            hidden
                        >

                            Submit Loan Request

                            <span class="material-symbols-outlined">
                                send
                            </span>

                        </button>


                    </div>


                </form>



                <!-- =================================================
                     RIGHT SUMMARY
                ================================================== -->

                <aside class="summary-card">


                    <div class="summary-heading">


                        <div class="summary-icon">

                            <span class="material-symbols-outlined">
                                assignment
                            </span>

                        </div>


                        <div>

                            <h3>
                                Loan Request Summary
                            </h3>

                            <p>
                                Your request details will appear here.
                            </p>

                        </div>


                    </div>



                    <!-- NOTICE:
                         LOAN TYPE REMOVED
                    -->


                    <div class="summary-row">

                        <span>
                            Amount
                        </span>

                        <strong id="summaryAmount">
                            Not specified
                        </strong>

                    </div>



                    <div class="summary-row">

                        <span>
                            Loan Purpose
                        </span>

                        <strong id="summaryPurpose">
                            Not selected
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Kasulatan
                        </span>

                        <strong id="summaryKasulatan">
                            Not uploaded
                        </strong>

                    </div>



                    <div class="summary-row">

                        <span>
                            Repayment Schedule
                        </span>

                        <strong id="summaryRepayment">
                            Not selected
                        </strong>

                    </div>



                    <!-- REMINDERS -->
                    <div class="reminders">


                        <div class="reminder-title">

                            <span class="material-symbols-outlined">
                                info
                            </span>

                            <strong>
                                Important Reminders
                            </strong>

                        </div>


                        <ul>


                            <?php if ($isNewApplicant): ?>

                                <li>
                                    As a new applicant,
                                    your maximum loan amount
                                    is ₱3,000.
                                </li>

                            <?php else: ?>

                                <li>
                                    Your requested amount is flexible
                                    and subject to lender approval.
                                </li>

                            <?php endif; ?>


                            <li>
                                Write a clear and sincere kasulatan.
                            </li>


                            <li>
                                Choose a repayment schedule
                                you can commit to.
                            </li>


                            <li>
                                Your request will be reviewed
                                by the lender.
                            </li>


                            <li>
                                You will be notified once your
                                request has been reviewed.
                            </li>


                        </ul>


                    </div>
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>

                </aside>


            </div>


        </div>


    </main>


</div>


<script src="js/request-loan.js"></script>


</body>

</html>