<?php $step = 'loan-preferences'; require __DIR__.'/../../ajax/profiling_page.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loan Preferences | Utang Wise</title>

    <link rel="stylesheet" href="../../assets/css/loan-preferences.css">

    <!-- Google Fonts -->
    

    <!-- Material Symbols -->
    
<link rel="stylesheet" href="../../assets/css/borrower-flow.css"><link rel="stylesheet" href="<?= e(base_url()) ?>/assets/css/local-fonts.css"></head>

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
                    <p>Your account has been successfully created.</p>
                </div>

            </div>


            <!-- VERIFY -->
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


            <!-- FINANCIAL -->
            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Financial Details</h3>
                </div>

            </div>


            <!-- REFERENCE -->
            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Reference Person</h3>
                </div>

            </div>


            <!-- LOAN PREFERENCES ACTIVE -->
            <div class="progress-item active">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Loan Preferences</h3>

                    <p>
                        Set your loan amount
                        and purpose.
                    </p>
                </div>

            </div>


            <!-- AGREEMENTS -->
            


            <!-- REVIEW -->
            <div class="progress-item last">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Ready for Review</h3>
                </div>

            </div>

        </div>


        <!-- SECURITY -->
        <div class="security-box">

            <span class="material-symbols-outlined">
                lock
            </span>

            <div>

                <h4>Secure & Trusted</h4>

                <p>
                    Your information is protected
                    and handled securely.
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

            <?php borrower_logout_button(); ?><div class="user-area">

                <span class="welcome-text">
                    Welcome,
                    <strong><?= e($u['user_fn'].' '.$u['user_ln']) ?></strong>
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



        <!-- =========================
             PAGE CONTENT
        ========================== -->
        <section class="page-content">


            <!-- HERO -->
            <div class="page-hero">

                <span class="step-label">
                    STEP 5 OF 5
                </span>


                <a href="verifyacc.php" class="back-link">

                    <span class="material-symbols-outlined">
                        arrow_back
                    </span>

                    Back to overview

                </a>


                <h1>Loan Preferences</h1>


                <p>
                    Set your preferred loan amount and purpose so we
                    can match you with the right options.
                </p>

            </div>



            <!-- =========================
                 TWO COLUMN CONTENT
            ========================== -->
            <div class="loan-layout">


                <!-- =========================
                     FORM CARD
                ========================== -->
                <section class="form-card">

                    <form action="../../ajax/save_borrower.php" method="POST" enctype="multipart/form-data" data-borrower-form><?php csrf(); notice(); ?><input type="hidden" name="step" value="loan-preferences">


                        <!-- LOAN AMOUNT -->
                        <div class="form-section">

                            <h2>1. Loan Amount</h2>

                            <p class="section-description">
                                How much would you like to borrow?
                            </p>


                            <div class="money-input">

                                <span class="peso">
                                    ₱
                                </span>

                                <input
                                    type="number"
                                    name="loan_amount"
                                    placeholder="Enter loan amount"
                                    min="3000" max="15000" step="1"
                                    list="allowedLoanAmounts"
                                 required value="<?= e($values['loan_amount'] ?? '') ?>">
                                <datalist id="allowedLoanAmounts">
                                    <option value="3000"></option>
                                    <option value="5000"></option>
                                    <option value="10000"></option>
                                    <option value="15000"></option>
                                </datalist>

                            </div>


                            <!-- QUICK AMOUNTS -->
                            <div class="quick-amounts">

                                <button type="button">
                                    ₱3,000.00
                                </button>

                                <button type="button">
                                    ₱5,000.00
                                </button>

                                <button type="button">
                                    ₱10,000.00
                                </button>

                                <button type="button">
                                    ₱15,000.00
                                </button>

                            </div>

                        </div>



                        <!-- LOAN PURPOSE -->
                        <div class="form-section">

                            <h2>2. Loan Purpose</h2>

                            <p class="section-description">
                                What will you use the loan for?
                            </p>


                            <div class="select-with-icon">

                                <span class="material-symbols-outlined">
                                    assignment
                                </span>

                                <select name="loan_purpose" required>

                                    <option value="" <?= ($values['loan_purpose'] ?? '') === '' ? 'selected' : '' ?> disabled>
                                        Select loan purpose
                                    </option>

                                    <option value="emergency" <?= ($values['loan_purpose'] ?? '') === 'emergency' ? 'selected' : '' ?>>
                                        Emergency Expenses
                                    </option>

                                    <option value="medical" <?= ($values['loan_purpose'] ?? '') === 'medical' ? 'selected' : '' ?>>
                                        Medical Expenses
                                    </option>

                                    <option value="education" <?= ($values['loan_purpose'] ?? '') === 'education' ? 'selected' : '' ?>>
                                        Education
                                    </option>

                                    <option value="business" <?= ($values['loan_purpose'] ?? '') === 'business' ? 'selected' : '' ?>>
                                        Business
                                    </option>

                                    <option value="bills" <?= ($values['loan_purpose'] ?? '') === 'bills' ? 'selected' : '' ?>>
                                        Bills / Utilities
                                    </option>

                                    <option value="home" <?= ($values['loan_purpose'] ?? '') === 'home' ? 'selected' : '' ?>>
                                        Home Expenses
                                    </option>

                                    <option value="personal" <?= ($values['loan_purpose'] ?? '') === 'personal' ? 'selected' : '' ?>>
                                        Personal Expenses
                                    </option>

                                    <option value="other" <?= ($values['loan_purpose'] ?? '') === 'other' ? 'selected' : '' ?>>
                                        Other
                                    </option>

                                </select>

                            </div>

                        </div>



                        <!-- LOAN TERM -->
                        <div class="form-section">

                            <h2>3. Preferred Loan Term</h2>

                            <p class="section-description">
                                How long do you need to repay?
                            </p>


                            <div class="term-options">


                                <!-- 3 MONTHS -->
                                <label class="term-card">

                                    <input
                                        type="radio"
                                        name="loan_term"
                                        value="3"
                                     required <?= ($values['loan_term'] ?? '') === '3' ? 'checked' : '' ?>>

                                    <div class="term-content">

                                        <div>
                                            <h3>3 Months</h3>

                                            <p>
                                                Lower monthly payment
                                            </p>
                                        </div>

                                        <span class="radio-circle"></span>

                                    </div>

                                </label>



                                <!-- 6 MONTHS -->
                                <label class="term-card">

                                    <input
                                        type="radio"
                                        name="loan_term"
                                        value="6"
                                       
                                     required <?= ($values['loan_term'] ?? '') === '6' ? 'checked' : '' ?>>

                                    <div class="term-content">

                                        <div>
                                            <h3>6 Months</h3>

                                            <p>
                                                Balanced option
                                            </p>
                                        </div>

                                        <span class="radio-circle"></span>

                                    </div>

                                </label>



                                <!-- 12 MONTHS -->
                                <label class="term-card">

                                    <input
                                        type="radio"
                                        name="loan_term"
                                        value="12"
                                     required <?= ($values['loan_term'] ?? '') === '12' ? 'checked' : '' ?>>

                                    <div class="term-content">

                                        <div>
                                            <h3>12 Months</h3>

                                            <p>
                                                Smaller monthly payment
                                            </p>
                                        </div>

                                        <span class="radio-circle"></span>

                                    </div>

                                </label>

                            </div>

                        </div>



                        <!-- ADDITIONAL INFO -->
                        <div class="form-section">

                            <h2>
                                4. Additional Information
                                <span>(Optional)</span>
                            </h2>

                            <p class="section-description">
                                Let us know if there's anything else
                                we should consider.
                            </p>


                            <div class="textarea-wrapper">

                                <textarea
                                    name="additional_information"
                                    maxlength="300"
                                    placeholder="Enter additional details (optional)"
                                ><?= e($values['additional_information'] ?? '') ?></textarea>

                                <span class="character-count">
                                    0/300
                                </span>

                            </div>

                        </div>



                        <!-- BUTTONS -->
                        <div class="form-actions">

                            <a
                                href="reference-person.php"
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
                            savings
                        </span>

                    </div>


                    <h2>
                        Choose what works for you
                    </h2>


                    <p class="info-description">
                        Your loan preferences help us provide
                        personalized options that fit your
                        financial needs and capacity.
                    </p>



                    <div class="info-list">


                        <!-- FLEXIBLE -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    shield
                                </span>

                            </div>


                            <div>

                                <h3>Flexible Options</h3>

                                <p>
                                    Choose the amount and term
                                    that suits your needs.
                                </p>

                            </div>

                        </div>



                        <!-- TRANSPARENT -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    percent
                                </span>

                            </div>


                            <div>

                                <h3>Transparent Rates</h3>

                                <p>
                                    We provide clear and upfront
                                    information.
                                </p>

                            </div>

                        </div>



                        <!-- RESPONSIBLE -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    handshake
                                </span>

                            </div>


                            <div>

                                <h3>A Smarter Way to Borrow</h3>

                                <p>
                                    We're here to support your
                                    goals responsibly.
                                </p>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </section>

    </main>

</div>

<script type="application/json" id="uw-profile-data"><?= json_encode($values, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script><script src="../../assets/js/borrower-profiling.js" defer></script><?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>
</html>
