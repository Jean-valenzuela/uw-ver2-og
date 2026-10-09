document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       MOBILE SIDEBAR
    ========================================= */

    const mobileMenuBtn =
        document.getElementById("mobileMenuBtn");

    const sidebar =
        document.getElementById("sidebar");

    const sidebarOverlay =
        document.getElementById("sidebarOverlay");


    if (
        mobileMenuBtn &&
        sidebar &&
        sidebarOverlay
    ) {

        mobileMenuBtn.addEventListener("click", function () {

            sidebar.classList.toggle("open");
            sidebarOverlay.classList.toggle("show");

        });


        sidebarOverlay.addEventListener("click", function () {

            sidebar.classList.remove("open");
            sidebarOverlay.classList.remove("show");

        });


        window.addEventListener("resize", function () {

            if (window.innerWidth > 1150) {

                sidebar.classList.remove("open");
                sidebarOverlay.classList.remove("show");

            }

        });

    }


    /* =========================================
       CHARACTER COUNTER
    ========================================= */

    const explanation =
        document.getElementById("extensionExplanation");

    const characterCount =
        document.getElementById("characterCount");


    if (explanation && characterCount) {

        explanation.addEventListener("input", function () {

            characterCount.textContent =
                explanation.value.length;

        });

    }


    /* =========================================
       DATE VALIDATION
    ========================================= */

    const requestedDueDate =
        document.getElementById("requestedDueDate");


    if (requestedDueDate) {

        const today = new Date();

        const tomorrow = new Date(today);

        tomorrow.setDate(
            tomorrow.getDate() + 1
        );


        const year =
            tomorrow.getFullYear();

        const month =
            String(
                tomorrow.getMonth() + 1
            ).padStart(2, "0");

        const day =
            String(
                tomorrow.getDate()
            ).padStart(2, "0");


        requestedDueDate.min =
            `${year}-${month}-${day}`;

    }


    /* =========================================
       CANCEL
    ========================================= */

    const cancelBtn =
        document.getElementById("cancelBtn");


    if (cancelBtn) {

        cancelBtn.addEventListener("click", function () {

            window.location.href =
                "my-loans.php";

        });

    }


    /* =========================================
       FORM SUBMIT
       TEMPORARY FRONT-END ONLY
    ========================================= */

    const extensionForm =
        document.getElementById("extensionForm");


    if (extensionForm) {

        extensionForm.addEventListener(
            "submit",
            function (event) {

                /*
                 * TEMPORARY:
                 * Prevent actual submission until
                 * backend/database is connected.
                 */

                event.preventDefault();


                const requestedDate =
                    requestedDueDate.value;

                const reason =
                    document.getElementById(
                        "extensionReason"
                    ).value;


                if (!requestedDate) {

                    alert(
                        "Please select your requested new due date."
                    );

                    return;

                }


                if (!reason) {

                    alert(
                        "Please select a reason for your extension request."
                    );

                    return;

                }


                alert(
                    "Extension request is ready. " +
                    "Backend submission can be connected later."
                );

            }
        );

    }

});