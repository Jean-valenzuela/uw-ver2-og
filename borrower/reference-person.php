<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reference Person | Utang Wise</title>

    <link rel="stylesheet" href="css/reference-person.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Google Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="page-layout">

    <!-- =====================================
         SIDEBAR
    ====================================== -->
    <aside class="sidebar">

        <!-- LOGO -->
        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div class="brand-text">
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <!-- PROGRESS -->
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


            <!-- REFERENCE ACTIVE -->
            <div class="progress-item active">

                <div class="progress-dot"></div>

                <div class="progress-text">
                    <h3>Reference Person</h3>

                    <p>
                        Provide a trusted
                        reference person.
                    </p>
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

                <h4>
                    Your data is safe and secure.
                </h4>

                <p>
                    We use industry-standard
                    security to protect your
                    information.
                </p>

            </div>

        </div>

    </aside>


    <!-- =====================================
         MAIN
    ====================================== -->
    <main class="main-content">


        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-space"></div>

            <div class="user-area">

                <span class="welcome-text">
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


        <!-- PAGE -->
        <section class="page-content">


            <!-- =====================================
                 HERO
            ====================================== -->
            <div class="page-hero">


                <div class="hero-copy">

                    <span class="step-label">
                        STEP 5 OF 6
                    </span>


                    <a href="verifyacc.php" class="back-link">

                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>

                        Back to overview

                    </a>


                    <h1>
                        Reference Person
                    </h1>


                    <p>
                        Provide the details of a trusted person
                        who can be contacted as a reference.
                    </p>

                </div>


                <!-- HERO ILLUSTRATION -->
                <div class="hero-illustration">

                    <div class="hero-shape"></div>


                    <div class="person person-one">

                        <span class="person-head"></span>
                        <span class="person-body"></span>

                    </div>


                    <div class="person person-two">

                        <span class="person-head"></span>
                        <span class="person-body"></span>

                    </div>


                    <div class="reference-card">

                        <span class="peso">
                            ₱
                        </span>

                        <div class="card-lines">
                            <span></span>
                            <span></span>
                        </div>

                    </div>

                </div>

            </div>



            <!-- =====================================
                 CONTENT
            ====================================== -->
            <div class="reference-layout">


                <!-- =====================================
                     FORM
                ====================================== -->
                <section class="form-card">

                    <form action="#" method="POST">


                        <!-- =============================
                             REFERENCE INFORMATION
                        ============================== -->
                        <div class="form-section">

                            <h2>
                                1. Reference Person's Information
                            </h2>


                            <div class="form-grid three-columns">


                                <!-- FULL NAME -->
                                <div class="form-group">

                                    <label for="reference_name">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_name"
                                        name="reference_name"
                                        placeholder="Enter full name"
                                    >

                                </div>


                                <!-- RELATIONSHIP -->
                                <div class="form-group">

                                    <label for="relationship">
                                        Relationship to You
                                    </label>

                                    <select
                                        id="relationship"
                                        name="relationship"
                                    >

                                        <option value="" selected disabled>
                                            Select relationship
                                        </option>

                                        <option value="parent">
                                            Parent
                                        </option>

                                        <option value="sibling">
                                            Sibling
                                        </option>

                                        <option value="relative">
                                            Relative
                                        </option>

                                        <option value="friend">
                                            Friend
                                        </option>

                                        <option value="coworker">
                                            Co-worker
                                        </option>

                                        <option value="employer">
                                            Employer
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <!-- CONTACT -->
                                <div class="form-group">

                                    <label for="reference_contact">
                                        Contact Number
                                    </label>

                                    <div class="phone-row">

                                        <div class="country-code">
                                            +63
                                        </div>

                                        <input
                                            type="tel"
                                            id="reference_contact"
                                            name="reference_contact"
                                            placeholder="912 345 6789"
                                        >

                                    </div>

                                </div>


                                <!-- EMAIL -->
                                <div class="form-group">

                                    <label for="reference_email">
                                        Email Address
                                        <span>(Optional)</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="reference_email"
                                        name="reference_email"
                                        placeholder="Enter email address"
                                    >

                                </div>


                                <!-- OCCUPATION -->
                                <div class="form-group">

                                    <label for="reference_occupation">
                                        Occupation
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_occupation"
                                        name="reference_occupation"
                                        placeholder="Enter occupation"
                                    >

                                </div>


                                <!-- COMPANY -->
                                <div class="form-group">

                                    <label for="reference_company">
                                        Company / Organization
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_company"
                                        name="reference_company"
                                        placeholder="Enter company or organization"
                                    >

                                </div>

                            </div>

                        </div>



                        <!-- =============================
                             ADDRESS
                        ============================== -->
                        <div class="form-section">

                            <h2>
                                2. Address
                            </h2>


                            <!-- FIRST ADDRESS ROW -->
                            <div class="address-grid address-top">


                                <div class="form-group">

                                    <label for="reference_street">
                                        House No. / Street
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_street"
                                        name="reference_street"
                                        placeholder="Enter house number and street"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="reference_barangay">
                                        Barangay
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_barangay"
                                        name="reference_barangay"
                                        placeholder="Enter barangay"
                                    >

                                </div>

                            </div>


                            <!-- SECOND ADDRESS ROW -->
                            <div class="address-grid address-bottom">


                                <div class="form-group">

                                    <label for="reference_city">
                                        City / Municipality
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_city"
                                        name="reference_city"
                                        placeholder="Enter city / municipality"
                                    >

                                </div>


                                <div class="form-group">

                                    <label for="reference_province">
                                        Province
                                    </label>

                                    <select
                                        id="reference_province"
                                        name="reference_province"
                                    >

                                        <option value="" selected disabled>
                                            Select province
                                        </option>

                                        <option value="metro-manila">
                                            Metro Manila
                                        </option>

                                        <option value="bulacan">
                                            Bulacan
                                        </option>

                                        <option value="cavite">
                                            Cavite
                                        </option>

                                        <option value="laguna">
                                            Laguna
                                        </option>

                                        <option value="rizal">
                                            Rizal
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label for="reference_zip">
                                        ZIP Code
                                    </label>

                                    <input
                                        type="text"
                                        id="reference_zip"
                                        name="reference_zip"
                                        placeholder="Enter ZIP code"
                                    >

                                </div>

                            </div>

                        </div>



                        <!-- =============================
                             ADDITIONAL INFORMATION
                        ============================== -->
                        <div class="form-section">

                            <h2>
                                3. Additional Information
                                <span>(Optional)</span>
                            </h2>


                            <div class="form-group">

                                <label for="reference_notes">
                                    Notes
                                </label>

                                <textarea
                                    id="reference_notes"
                                    name="reference_notes"
                                    placeholder="Add any additional notes (optional)"
                                ></textarea>

                            </div>

                        </div>



                        <!-- =============================
                             ACTIONS
                        ============================== -->
                        <div class="form-actions">


                            <a
                                href="financial-details.php"
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



                <!-- =====================================
                     RIGHT INFO
                ====================================== -->
                <aside class="info-panel">


                    <div class="main-info-icon">

                        <span class="material-symbols-outlined">
                            shield_person
                        </span>

                    </div>


                    <h2>
                        Why do we ask for a reference person?
                    </h2>


                    <p class="info-description">

                        A reference person helps us verify
                        your information and may be contacted
                        if we need additional confirmation
                        during your loan application.

                    </p>



                    <div class="info-list">


                        <!-- ITEM 1 -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    group
                                </span>

                            </div>


                            <div>

                                <h3>
                                    Verification Support
                                </h3>

                                <p>
                                    Helps us confirm your
                                    identity and details.
                                </p>

                            </div>

                        </div>



                        <!-- ITEM 2 -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    schedule
                                </span>

                            </div>


                            <div>

                                <h3>
                                    Faster Processing
                                </h3>

                                <p>
                                    Allows us to process your
                                    application smoothly.
                                </p>

                            </div>

                        </div>



                        <!-- ITEM 3 -->
                        <div class="info-item">

                            <div class="info-icon">

                                <span class="material-symbols-outlined">
                                    lock
                                </span>

                            </div>


                            <div>

                                <h3>
                                    Secure & Confidential
                                </h3>

                                <p>
                                    Their information is kept
                                    strictly confidential.
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