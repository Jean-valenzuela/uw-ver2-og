<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Details | Utang Wise</title>

    <link rel="stylesheet" href="../css/personal-details.css">

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



            <!-- PERSONAL DETAILS -->
            <div class="progress-item active">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Personal Details</h3>

                    <p>
                        kumabaga get to know eachother.
                    </p>
                </div>

            </div>


            <!-- FINANCIAL -->
            <div class="progress-item">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Financial Details</h3>
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


        <!-- SECURITY -->
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
         MAIN
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
                        STEP 3 OF 6
                    </span>

                    <a href="verifyacc.php" class="back-link">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to overview

                    </a>

                    <h1>
                        Personal Details
                    </h1>

                    <p>
                        Please provide your personal information.
                    </p>

                </div>


            </div>



            <!-- =========================
                 BODY
            ========================== -->
            <div class="details-layout">

                <!-- FORM -->
                <section class="form-card">

                    <form action="#" method="POST">


                        <!-- BASIC INFORMATION -->
                        <div class="form-section">

                            <h2>
                                Basic Information
                            </h2>

                            <div class="form-grid three-columns">

                                <div class="form-group">

                                    <label for="first_name">
                                        First Name
                                    </label>

                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        placeholder="Enter first name"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="middle_name">
                                        Middle Name
                                        <span>(Optional)</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="middle_name"
                                        name="middle_name"
                                        placeholder="Enter middle name"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="last_name">
                                        Last Name
                                    </label>

                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        placeholder="Enter last name"
                                    >

                                </div>



                                <div class="form-group">

                                    <label for="birth_date">
                                        Date of Birth
                                    </label>

                                    <div class="input-icon">

                                        <span class="material-symbols-outlined">
                                            calendar_month
                                        </span>

                                        <input
                                            type="date"
                                            id="birth_date"
                                            name="birth_date"
                                        >

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label for="gender">
                                        Gender
                                    </label>

                                    <select
                                        id="gender"
                                        name="gender"
                                    >
                                        <option value="" selected disabled>
                                            Select gender
                                        </option>

                                        <option value="male">
                                            Male
                                        </option>

                                        <option value="female">
                                            Female
                                        </option>

                                        <option value="prefer-not">
                                            Prefer not to say
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="civil_status">
                                        Civil Status
                                    </label>

                                    <select
                                        id="civil_status"
                                        name="civil_status"
                                    >
                                        <option value="" selected disabled>
                                            Select civil status
                                        </option>

                                        <option value="single">
                                            Single
                                        </option>

                                        <option value="married">
                                            Married
                                        </option>

                                        <option value="widowed">
                                            Widowed
                                        </option>

                                        <option value="separated">
                                            Separated
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="nationality">
                                        Nationality
                                    </label>

                                    <select
                                        id="nationality"
                                        name="nationality"
                                    >
                                        <option value="Filipino">
                                            Filipino
                                        </option>

                                        <option value="Other">
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="religion">
                                        Religion
                                    </label>

                                    <select
                                        id="religion"
                                        name="religion"
                                    >
                                        <option value="" selected disabled>
                                            Select religion
                                        </option>

                                        <option value="Roman Catholic">
                                            Roman Catholic
                                        </option>

                                        <option value="Christian">
                                            Christian
                                        </option>

                                        <option value="Islam">
                                            Islam
                                        </option>

                                        <option value="Other">
                                            Other
                                        </option>

                                        <option value="Prefer not to say">
                                            Prefer not to say
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="tin">
                                        TIN
                                        <span>(Optional)</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="tin"
                                        name="tin"
                                        placeholder="Enter TIN"
                                    >

                                </div>

                            </div>

                        </div>



                        <!-- CONTACT INFORMATION -->
                        <div class="form-section">

                            <h2>
                                Contact Information
                            </h2>

                            <div class="contact-grid">

                                <div class="form-group">

                                    <label for="mobile">
                                        Mobile Number
                                    </label>

                                    <div class="phone-row">

                                        <div class="country-code">
                                            +63
                                        </div>

                                        <input
                                            type="tel"
                                            id="mobile"
                                            name="mobile"
                                            placeholder="912 345 6789"
                                        >

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label for="email">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        placeholder="Enter email address"
                                    >

                                </div>

                            </div>

                        </div>



                        <!-- CURRENT ADDRESS -->
                        <div class="form-section address-section">

                            <h2>
                                Current Address
                            </h2>


                            <div class="address-grid top-address">

                                <div class="form-group">

                                    <label for="street">
                                        House No. / Street
                                    </label>

                                    <input
                                        type="text"
                                        id="street"
                                        name="street"
                                        placeholder="Enter house number and street"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="barangay">
                                        Barangay
                                    </label>

                                    <input
                                        type="text"
                                        id="barangay"
                                        name="barangay"
                                        placeholder="Enter barangay"
                                    >

                                </div>

                            </div>


                            <div class="address-grid bottom-address">

                                <div class="form-group">

                                    <label for="city">
                                        City / Municipality
                                    </label>

                                    <input
                                        type="text"
                                        id="city"
                                        name="city"
                                        placeholder="Enter city / municipality"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="province">
                                        Province
                                    </label>

                                    <input
                                        type="text"
                                        id="province"
                                        name="province"
                                        placeholder="Enter province"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="zip_code">
                                        ZIP Code
                                    </label>

                                    <input
                                        type="text"
                                        id="zip_code"
                                        name="zip_code"
                                        placeholder="ZIP Code"
                                    >

                                </div>

                            </div>

                        </div>



                        <!-- BUTTONS -->
                        <div class="form-actions">

                            <a href="verifyacc.php" class="back-button">

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
                        We collect your personal details to verify
                        your identity, assess your loan application,
                        and keep you updated throughout the process.
                    </p>


                    <div class="info-list">

                        <div class="info-item">

                            <div class="info-icon">
                                <span class="material-symbols-outlined">
                                    lock
                                </span>
                            </div>

                            <div>
                                <h3>Secure & Private</h3>

                                <p>
                                    Your information is protected
                                    and handled securely.
                                </p>
                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-icon">
                                <span class="material-symbols-outlined">
                                    fact_check
                                </span>
                            </div>

                            <div>
                                <h3>Accurate Assessment</h3>

                                <p>
                                    Helps us evaluate your loan
                                    application fairly.
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
                                <h3>Better Experience</h3>

                                <p>
                                    Allows us to provide a smoother
                                    and more personalized service.
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