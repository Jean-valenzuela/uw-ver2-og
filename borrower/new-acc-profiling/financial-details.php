<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Financial Details | Utang Wise</title>

    <link rel="stylesheet" href="../css/financial-details.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body>

<div class="page-layout">

    <!-- =========================
         SIDEBAR
    ========================== -->
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


        <div class="progress-list">

            <!-- ACCOUNT CREATED -->
            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Account Created</h3>

                    <p>
                        Your account has been
                        successfully created.
                    </p>
                </div>

            </div>


            <!-- VERIFY ACCOUNT -->
            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Verify Account</h3>
                </div>

            </div>

            
              <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>ID Verification</h3>

                    <p>
                        chuchcu mamaya na to..
                    </p>
                </div>

            </div>



            <!-- PERSONAL -->
            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Personal Details</h3>
                </div>

            </div>


            <!-- FINANCIAL ACTIVE -->
            <div class="progress-item active">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Financial Details</h3>

                    <p>
                        Tell us about your
                        financial background.
                    </p>
                </div>

            </div>


            <!-- REFERENCE -->
            <div class="progress-item">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Reference Person</h3>
                </div>

            </div>


            <!-- LOAN -->
            <div class="progress-item">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Loan Preferences</h3>
                </div>

            </div>


            <!-- AGREEMENTS -->
            <div class="progress-item">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Agreements</h3>
                </div>

            </div>


            <!-- REVIEW -->
            <div class="progress-item last">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Ready for Review</h3>
                </div>

            </div>

        </div>


        <!-- SECURITY BOX -->
        <div class="security-box">

            <span class="material-symbols-outlined">
                shield
            </span>

            <div>
                <h4>Your data is safe and secure.</h4>

                <p>
                    We use industry-standard
                    security to protect your
                    information.
                </p>
            </div>

        </div>

    </aside>



    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-space"></div>

            <div class="user-area">

                <span>
                    Welcome,
                    <strong>Juan Dela Cruz</strong>
                </span>

                <span class="material-symbols-outlined">
                    keyboard_arrow_down
                </span>

                <span class="material-symbols-outlined notification">
                    notifications
                </span>

                <div class="user-circle">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </div>

            </div>

        </header>



        <section class="page-content">

            <!-- =========================
                 HERO
            ========================== -->
            <div class="page-hero">

                <div class="hero-copy">

                    <span class="step-label">
                        STEP 4 OF 6
                    </span>

                    <a href="verifyacc.php" class="back-link">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to overview

                    </a>

                    <h1>
                        Financial Details
                    </h1>

                    <p>
                        Help us understand your income and financial
                        background to assess your loan application.
                    </p>

                </div>


                <!-- HERO ILLUSTRATION -->
                <div class="hero-illustration">

                    <div class="hero-shape"></div>

                    <div class="report">

                        <div class="report-circle"></div>

                        <div class="report-lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="report-bars">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </div>


                    <div class="calculator">

                        <span class="material-symbols-outlined">
                            calculate
                        </span>

                    </div>

                </div>

            </div>



            <!-- =========================
                 CONTENT GRID
            ========================== -->
            <div class="financial-layout">

                <!-- =========================
                     FORM
                ========================== -->
                <section class="form-card">

                    <form action="#" method="POST">


                        <!-- =========================
                             EMPLOYMENT
                        ========================== -->
                        <div class="form-section">

                            <h2>
                                1. Employment Information
                            </h2>

                            <div class="form-grid three-columns">


                                <div class="form-group">

                                    <label for="employment_status">
                                        Employment Status
                                    </label>

                                    <select
                                        id="employment_status"
                                        name="employment_status"
                                    >
                                        <option value="" selected disabled>
                                            Select status
                                        </option>

                                        <option value="employed">
                                            Employed
                                        </option>

                                        <option value="self-employed">
                                            Self-Employed
                                        </option>

                                        <option value="student">
                                            Student
                                        </option>

                                        <option value="unemployed">
                                            Unemployed
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="job_title">
                                        Job Title / Position
                                    </label>

                                    <input
                                        type="text"
                                        id="job_title"
                                        name="job_title"
                                        placeholder="e.g. Software Engineer"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="company">
                                        Company / Employer
                                    </label>

                                    <input
                                        type="text"
                                        id="company"
                                        name="company"
                                        placeholder="e.g. ABC Corporation"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="work_type">
                                        Type of Work
                                    </label>

                                    <select
                                        id="work_type"
                                        name="work_type"
                                    >
                                        <option value="" selected disabled>
                                            Select type
                                        </option>

                                        <option value="full-time">
                                            Full-time
                                        </option>

                                        <option value="part-time">
                                            Part-time
                                        </option>

                                        <option value="contractual">
                                            Contractual
                                        </option>

                                        <option value="freelance">
                                            Freelance
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="years_job">
                                        Years in Current Job
                                    </label>

                                    <select
                                        id="years_job"
                                        name="years_job"
                                    >
                                        <option value="" selected disabled>
                                            Select duration
                                        </option>

                                        <option value="less-than-1">
                                            Less than 1 year
                                        </option>

                                        <option value="1">
                                            1 year
                                        </option>

                                        <option value="2">
                                            2 years
                                        </option>

                                        <option value="3">
                                            3 years
                                        </option>

                                        <option value="4-plus">
                                            4+ years
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="gross_income">
                                        Monthly Gross Income
                                    </label>

                                    <div class="money-input">

                                        <span>₱</span>

                                        <input
                                            type="number"
                                            id="gross_income"
                                            name="gross_income"
                                            placeholder="e.g. 35,000"
                                            min="0"
                                        >

                                    </div>

                                </div>

                            </div>

                            <div class="coe-upload-section">

    <div class="coe-upload-title">
        <span class="material-symbols-outlined">
            upload_file
        </span>

        <span>Upload COE</span>
    </div>

    <p class="coe-upload-description">
        Upload your Certificate of Employment.
    </p>

    <div class="coe-upload-box">

        <div class="coe-file-info">

            <div class="coe-file-icon">
                <span class="material-symbols-outlined">
                    description
                </span>
            </div>

            <div class="coe-file-text">
                <strong>Certificate of Employment</strong>
                <span>PDF, JPG or PNG • Max 5MB</span>
            </div>

        </div>

        <label class="coe-upload-btn" for="coeFile">
            <span class="material-symbols-outlined">
                upload
            </span>

            Choose File
        </label>

        <input
            type="file"
            id="coeFile"
            name="coe"
            accept=".pdf,.jpg,.jpeg,.png"
            hidden
        >

    </div>

    <div class="coe-file-name" id="coeFileName">
        No file selected
    </div>

</div>
                        </div>


                        <!-- =========================
                             OTHER INCOME
                        ========================== -->
                        <div class="form-section">

                            <h2>
                                2. Other Income
                                <span>(Optional)</span>
                            </h2>


                            <div class="radio-question">

                                <p>
                                    Do you have other sources of income?
                                </p>


                                <label class="radio-option">

                                    <input
                                        type="radio"
                                        name="has_other_income"
                                        value="yes"
                                    >

                                    <span>Yes</span>

                                </label>


                                <label class="radio-option">

                                    <input
                                        type="radio"
                                        name="has_other_income"
                                        value="no"
                                    >

                                    <span>No</span>

                                </label>

                            </div>


                            <div class="other-income-box">

                                <div class="form-group">

                                    <label for="income_source">
                                        Source of Income
                                    </label>

                                    <input
                                        type="text"
                                        id="income_source"
                                        name="income_source"
                                        placeholder="e.g. Freelance, Business"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="other_income">
                                        Monthly Income
                                    </label>

                                    <div class="money-input">

                                        <span>₱</span>

                                        <input
                                            type="number"
                                            id="other_income"
                                            name="other_income"
                                            placeholder="e.g. 10,000"
                                            min="0"
                                        >

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="add-income-button"
                                >

                                    <span class="material-symbols-outlined">
                                        add
                                    </span>

                                    Add Another Income

                                </button>

                            </div>

                        </div>



                        <!-- =========================
                             FINANCIAL INFORMATION
                        ========================== -->
                        <div class="form-section">

                            <h2>
                                3. Financial Information
                            </h2>


                            <div class="form-grid three-columns">

                                <div class="form-group">

                                    <label for="expenses">
                                        Average Monthly Expenses
                                    </label>

                                    <div class="money-input">

                                        <span>₱</span>

                                        <input
                                            type="number"
                                            id="expenses"
                                            name="expenses"
                                            placeholder="e.g. 20,000"
                                            min="0"
                                        >

                                    </div>

                                </div>


                               

                                <div class="form-group">

                                    <label for="total_income">
                                        Total Monthly Income
                                    </label>

                                    <div class="money-input">

                                        <span>₱</span>

                                        <input
                                            type="number"
                                            id="total_income"
                                            name="total_income"
                                            placeholder="e.g. 35,000"
                                            min="0"
                                        >

                                    </div>

                                </div>

                            </div>


                            <div class="loan-row">

                                <div class="existing-loan">

                                    <p>
                                        Do you have existing loans?
                                    </p>

                                    <div class="radio-row">

                                        <label class="radio-option">

                                            <input
                                                type="radio"
                                                name="has_loans"
                                                value="yes"
                                            >

                                            <span>Yes</span>

                                        </label>


                                        <label class="radio-option">

                                            <input
                                                type="radio"
                                                name="has_loans"
                                                value="no"
                                            >

                                            <span>No</span>

                                        </label>

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label for="loan_balance">
                                        If yes, total outstanding balance
                                    </label>

                                    <div class="money-input">

                                        <span>₱</span>

                                        <input
                                            type="number"
                                            id="loan_balance"
                                            name="loan_balance"
                                            placeholder="e.g. 50,000"
                                            min="0"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- ACTION BUTTONS -->
                        <div class="form-actions">

                            <a
                                href="personal-details.php"
                                class="back-button"
                            >

                                <span class="material-symbols-outlined">
                                    arrow_back
                                </span>

                                Back

                            </a>


                            <button
                                type="submit"
                                class="continue-button"
                            >

                                Continue

                                <span class="material-symbols-outlined">
                                    arrow_forward
                                </span>

                            </button>

                        </div>

                    </form>

                </section>



                <!-- =========================
                     RIGHT INFO PANEL
                ========================== -->
                <aside class="info-panel">

                    <div class="main-info-icon">

                        <span class="material-symbols-outlined">
                            shield_lock
                        </span>

                    </div>


                    <h2>
                        Why we need this information
                    </h2>


                    <p class="info-description">
                        This information helps us evaluate your
                        ability to repay and helps us offer a loan
                        suited to your financial situation.
                    </p>


                    <div class="info-list">


                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    fact_check
                                </span>

                            </div>

                            <div>

                                <h3>
                                    Fair Assessment
                                </h3>

                                <p>
                                    We carefully assess your
                                    financial capacity.
                                </p>

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    handshake
                                </span>

                            </div>

                            <div>

                                <h3>
                                    Responsible Lending
                                </h3>

                                <p>
                                    Helps us provide a loan
                                    you can comfortably repay.
                                </p>

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    verified_user
                                </span>

                            </div>

                            <div>

                                <h3>
                                    Data Protection
                                </h3>

                                <p>
                                    Your financial data is kept
                                    confidential and secure.
                                </p>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </section>

    </main>

</div>

</body>
</html>