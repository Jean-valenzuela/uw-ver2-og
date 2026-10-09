<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Our Lenders | Utang Wise</title>

    <!-- GOOGLE FONTS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL SYMBOLS -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    >

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="../assets/css/lender.css"
    >
</head>

<body>


<!-- =====================================================
     NAVBAR
====================================================== -->

<header class="main-header">

    <nav class="navbar">

        <!-- BRAND -->
        <a
            href="index.php"
            class="nav-brand"
        >
            <img
                src="logo/utangwiselogo.png"
                alt="Utang Wise Logo"
            >

            <div class="brand-text">
                <strong>UTANG WISE</strong>
                <span>SMART LENDING. BRIGHTER FUTURES.</span>
            </div>
        </a>


        <!-- NAVIGATION -->
        <div class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="index.php#about">
                About Us
            </a>

            <a href="index.php#how-it-works">
                How it Works
            </a>

            <a
                href="lenders.php"
                class="active"
            >
                Lenders
            </a>

        </div>


        <!-- ACTIONS -->
        <div class="nav-actions">

            <a
                href="login.php"
                class="login-btn"
            >
                Login
            </a>

            <a
                href="register.php"
                class="register-btn"
            >
                Register
            </a>

        </div>


        <!-- MOBILE MENU BUTTON -->
        <button
            type="button"
            class="mobile-menu-btn"
            id="mobileMenuBtn"
            aria-label="Open navigation"
        >
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>

    </nav>


    <!-- MOBILE NAVIGATION -->
    <div
        class="mobile-nav"
        id="mobileNav"
    >

        <a href="index.php">
            Home
        </a>

        <a href="index.php#about">
            About Us
        </a>

        <a href="index.php#how-it-works">
            How it Works
        </a>

        <a
            href="lenders.php"
            class="active"
        >
            Lenders
        </a>

        <div class="mobile-actions">

            <a href="login.php">
                Login
            </a>

            <a
                href="register.php"
                class="mobile-register"
            >
                Register
            </a>

        </div>

    </div>

</header>


<!-- =====================================================
     OUR LENDERS
====================================================== -->

<main>

<section
    class="lenders-section"
    id="lenders"
>

    <div class="lenders-container">


        <!-- SECTION HEADER -->
        <div class="lenders-heading">

            <span class="section-tag">
                OUR LENDERS
            </span>

            <h1>
                Meet Our <span>Lenders</span>
            </h1>

            <div class="heading-line"></div>

            <p>
                Trusted and verified lenders who are ready to
                support your financial needs.
                <br>
                Find a lender that matches your goals.
            </p>

        </div>


        <!-- =================================================
             LENDERS GRID
        ================================================== -->

        <div class="lenders-grid">


            <!-- LENDER 1 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="./lenders/hehe.jpg"
                        alt="riz riz"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>riz riz</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Small Business Owner
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Manila
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            120+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Helping individuals and small businesses
                        achieve their goals through flexible and
                        fair lending.
                    </p>


                    <a
                        href="loan-application.php?lender_id=1"
                        class="apply-lender-btn navy-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 2 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="./lenders/hihi.jpg"
                        alt="yseiauh"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>yseia</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Freelance Professional
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Quezon City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            90+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Supporting personal and educational needs
                        with simple and reliable loan options.
                    </p>


                    <a
                        href="loan-application.php?lender_id=2"
                        class="apply-lender-btn gold-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 3 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="./lenders/bwehehe.jpg"
                        alt="Pedro Reyes"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>riri</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Entrepreneur
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Pasig City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            150+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Committed to helping hardworking individuals
                        through accessible and transparent lending.
                    </p>


                    <a
                        href="loan-application.php?lender_id=3"
                        class="apply-lender-btn navy-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 4 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="./lenders/hihihi.jpg"
                        alt="Anna Lim"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>antartica</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Retail Business Owner
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Makati City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            100+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Providing financial support for personal,
                        family, and business needs with flexible terms.
                    </p>


                    <a
                        href="loan-application.php?lender_id=4"
                        class="apply-lender-btn gold-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 5 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="images/lenders/lender-5.jpg"
                        alt="Mark Villanueva"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>Mark Villanueva</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            IT Professional
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Taguig City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            80+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Supporting your financial goals with fair
                        terms and hassle-free processing.
                    </p>


                    <a
                        href="loan-application.php?lender_id=5"
                        class="apply-lender-btn gold-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 6 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="images/lenders/lender-6.jpg"
                        alt="Camille Torres"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>Camille Torres</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Small Business Owner
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Mandaluyong City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            110+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Helping borrowers move forward with reliable
                        and personalized loan options.
                    </p>


                    <a
                        href="loan-application.php?lender_id=6"
                        class="apply-lender-btn navy-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 7 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="images/lenders/lender-7.jpg"
                        alt="Rafael Tan"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>Rafael Tan</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Entrepreneur
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            Pasay City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            130+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Financial assistance for personal and business
                        needs with a simple application process.
                    </p>


                    <a
                        href="loan-application.php?lender_id=7"
                        class="apply-lender-btn gold-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>


            <!-- LENDER 8 -->
            <article class="lender-card">

                <div class="lender-image">

                    <img
                        src="images/lenders/lender-8.jpg"
                        alt="Isabelle Cruz"
                    >

                    <span class="verified-badge">
                        <span class="material-symbols-outlined">
                            verified
                        </span>

                        Verified Lender
                    </span>

                </div>


                <div class="lender-content">

                    <h2>Isabelle Cruz</h2>

                    <div class="lender-details">

                        <p>
                            <span class="material-symbols-outlined">
                                work
                            </span>

                            Freelance Professional
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            San Juan City
                        </p>

                        <p>
                            <span class="material-symbols-outlined">
                                groups
                            </span>

                            95+ Borrowers
                        </p>

                    </div>


                    <div class="lender-divider"></div>


                    <p class="lender-description">
                        Supporting students, professionals, and families
                        with convenient and flexible lending.
                    </p>


                    <a
                        href="loan-application.php?lender_id=8"
                        class="apply-lender-btn navy-btn"
                    >
                        Apply Now

                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>

                </div>

            </article>

        </div>

    </div>

</section>

</main>


<!-- =====================================================
     MOBILE NAVIGATION JS
====================================================== -->

<script>
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const mobileNav = document.getElementById("mobileNav");

    mobileMenuBtn.addEventListener("click", function () {
        mobileNav.classList.toggle("show");
    });
</script>

</body>
</html>