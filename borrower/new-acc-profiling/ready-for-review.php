<?php $step='ready-for-review'; require __DIR__.'/../../ajax/profiling_page.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ready for Review | Utang Wise</title>

    <link rel="stylesheet" href="../../assets/css/ready-for-review.css">

    

    
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


            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Verify Account</h3>

                    <p>
                        Complete the steps below to verify
                        your identity and finish your profile.
                    </p>
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




            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Personal Details</h3>

                    <p>
                        Tell us about yourself.
                    </p>
                </div>

            </div>


            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Financial Details</h3>

                    <p>
                        Share your financial information.
                    </p>
                </div>

            </div>


            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Reference Person</h3>

                    <p>
                        Provide a trusted reference.
                    </p>
                </div>

            </div>


            <div class="progress-item completed">

                <div class="progress-dot">
                    <span class="material-symbols-outlined">
                        check
                    </span>
                </div>

                <div class="progress-text">
                    <h3>Loan Preferences</h3>

                    <p>
                        Set your loan amount and purpose.
                    </p>
                </div>

            </div>


            


            <div class="progress-item active last">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Ready for Review</h3>

                    <p>
                        Check your information
                        before submitting.
                    </p>
                </div>

            </div>

        </div>


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

            <div class="page-hero">

                <span class="step-label">
                    FINAL STEP
                </span>

                <h1>
                    Ready for Review
                </h1>

                <p>
                    Take a moment to review your information
                    before submitting your application.
                </p>

            </div>


            <?php require __DIR__.'/../../ajax/borrower_review.php'; ?></section>
</main>

</div>

<?php if(function_exists('uw_success_assets'))uw_success_assets(); ?></body>
</html>