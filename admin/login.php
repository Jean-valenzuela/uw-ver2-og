<?php require __DIR__."/../ajax/app.php"; if ($logged=current_user()) go(destination($logged)); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Utang Wise</title>

    <!-- LOGIN CSS -->
    <link
        rel="stylesheet"
        href="../assets/css/login.css"
    >

    <!-- DM SANS -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- PLAYFAIR DISPLAY -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <!-- MATERIAL SYMBOLS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>


<body>

    <main class="login-page">

        <div class="login-card">

            <section class="login-visual">

                <div class="brand">

                    <img
                        src="./logo/utangwiselogo.png"
                        alt="Utang Wise Logo"
                        class="brand-logo"
                    >

                    <div class="brand-name">

                        <h2>
                            UTANG WISE
                        </h2>

                        <span>
                            LENDING MADE SIMPLE
                        </span>

                    </div>

                </div>

                <div class="visual-content">

                    <h1>
                        Your goals,<br>
                        within reach.
                    </h1>

                    <p>
                        Simple, secure, and reliable financial support
                        <br>
                        when you need it.
                    </p>

                    <div class="gold-line"></div>

                    <div class="login-illustration">

                        <div class="illustration-bg"></div>

                        <div class="person">

                            <div class="person-head"></div>
                            <div class="person-body"></div>

                        </div>


                        <!-- LAPTOP -->
                        <div class="laptop">

                            <span>
                                UW
                            </span>

                        </div>


                        <!-- DECORATION -->
                        <div class="security-icon">

                            <span class="material-symbols-outlined">
                                lock
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =====================================================
                 RIGHT SIDE
            ====================================================== -->

            <section class="login-form-side">

                <div class="login-form-wrapper">

                    <!-- HEADING -->
                    <div class="login-heading">

                        <h1>
                            Admin Login
                        </h1>

                        <p>
                            Please log in to your account
                        </p>

                    </div>


                    <!-- =================================================
                         LOGIN FORM
                    ================================================== -->

                    <form
                        action="../ajax/login.php"
                        method="POST"
                        class="login-form"
                    ><?php csrf(); notice(); ?><input type="hidden" name="portal" value="admin">

                        <!-- EMAIL -->
                        <div class="form-group">

                            <label for="email">
                                Email Address
                            </label>

                            <div class="input-box">

                                <span class="material-symbols-outlined">
                                    mail
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    required
                                >

                            </div>

                        </div>


                        <!-- PASSWORD -->
                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="input-box">

                                <span class="material-symbols-outlined">
                                    lock
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Show password"
                                >

                                    <span
                                        class="material-symbols-outlined"
                                        id="passwordIcon"
                                    >
                                        visibility
                                    </span>

                                </button>

                            </div>


                            <div class="forgot-password">

                                <a href="forgot-password.php">
                                    Forgot password?
                                </a>

                            </div>

                        </div>


                        <!-- LOGIN BUTTON -->
                        <button
                            type="submit"
                            name="login"
                            class="login-btn"
                        >

                            <span class="material-symbols-outlined">
                                login
                            </span>

                            Log In

                        </button>

                    </form>


                    <!-- DIVIDER -->
                    <div class="or-divider">

                        <span></span>

                        <p>
                            OR
                        </p>

                        <span></span>

                    </div>


                    <!-- REGISTER -->
                    <div class="register-link">

                        <span>
                            Don't have an account?
                        </span>

                        <a href="register.php">
                            Register here
                        </a>

                    </div>

                </div>

            </section>

        </div>

    </main>


    <!-- =====================================================
         PASSWORD SHOW / HIDE
    ====================================================== -->

    <script>

        const passwordInput =
            document.getElementById("password");

        const passwordToggle =
            document.getElementById("passwordToggle");

        const passwordIcon =
            document.getElementById("passwordIcon");


        if (
            passwordInput &&
            passwordToggle &&
            passwordIcon
        ) {

            passwordToggle.addEventListener(
                "click",
                function () {

                    const isPassword =
                        passwordInput.type === "password";


                    passwordInput.type =
                        isPassword
                            ? "text"
                            : "password";


                    passwordIcon.textContent =
                        isPassword
                            ? "visibility_off"
                            : "visibility";


                    passwordToggle.setAttribute(
                        "aria-label",
                        isPassword
                            ? "Hide password"
                            : "Show password"
                    );

                }
            );

        }

    </script>

</body>

</html>