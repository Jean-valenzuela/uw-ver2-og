document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ====================================================== */

    const form = document.getElementById("loanRequestForm");

    const steps = document.querySelectorAll(".form-step");
    const progressSteps = document.querySelectorAll(".progress-step");

    const nextButton = document.getElementById("nextButton");
    const backButton = document.getElementById("backButton");
    const cancelButton = document.getElementById("cancelButton");
    const submitButton = document.getElementById("submitButton");

    const loanAmount = document.getElementById("loanAmount");

    /* NEW — LOAN PURPOSE */
    const loanPurpose = document.getElementById("loanPurpose");
    const purposeDetails = document.getElementById("purposeDetails");
    const purposeCharacterCount =
        document.getElementById("purposeCharacterCount");

    const kasulatanFile = document.getElementById("kasulatanFile");
    const fileNameText = document.getElementById("fileNameText");

    const repaymentOptions =
        document.querySelectorAll('input[name="repayment_schedule"]');

    const summaryAmount = document.getElementById("summaryAmount");

    /* NEW — PURPOSE SUMMARY */
    const summaryPurpose = document.getElementById("summaryPurpose");

    const summaryKasulatan =
        document.getElementById("summaryKasulatan");

    const summaryRepayment =
        document.getElementById("summaryRepayment");


    let currentStep = 1;


    /* =====================================================
       MOBILE SIDEBAR
    ====================================================== */

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


    /* =====================================================
       SHOW STEP
    ====================================================== */

    function showStep(stepNumber) {

        currentStep = stepNumber;


        /* FORM STEPS */

        steps.forEach(function (step) {

            const stepValue =
                Number(step.dataset.step);

            step.classList.toggle(
                "active",
                stepValue === stepNumber
            );

        });


        /* PROGRESS STEPS */

        progressSteps.forEach(function (step) {

            const progressValue =
                Number(step.dataset.progress);

            step.classList.remove(
                "active",
                "completed"
            );


            if (progressValue === stepNumber) {

                step.classList.add("active");

            } else if (progressValue < stepNumber) {

                step.classList.add("completed");

            }

        });


        /* =============================================
           BUTTONS
        ============================================== */

        if (stepNumber === 1) {

            backButton.hidden = true;
            cancelButton.hidden = false;

            nextButton.hidden = false;
            submitButton.hidden = true;

        }


        if (stepNumber === 2) {

            backButton.hidden = false;
            cancelButton.hidden = true;

            nextButton.hidden = false;
            submitButton.hidden = true;

        }


        if (stepNumber === 3) {

            backButton.hidden = false;
            cancelButton.hidden = true;

            nextButton.hidden = false;
            submitButton.hidden = true;

        }


        if (stepNumber === 4) {

            backButton.hidden = false;
            cancelButton.hidden = true;

            nextButton.hidden = true;
            submitButton.hidden = false;

        }


        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    }


    /* =====================================================
       VALIDATE CURRENT STEP
    ====================================================== */

    function validateCurrentStep() {

        /* =================================================
           STEP 1 — AMOUNT
        ================================================== */

        if (currentStep === 1) {

            const amount =
                Number(loanAmount.value);


            if (
                !loanAmount.value ||
                amount <= 0
            ) {

                Swal.fire({
                    icon: "warning",
                    title: "Loan Amount Required",
                    text: "Please enter the amount you want to borrow.",
                    confirmButtonText: "Okay",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                }).then(function () {

                    loanAmount.focus();

                });


                return false;

            }


            /*
             * NEW APPLICANT MAXIMUM:
             * ₱3,000
             */

            const maxLoan =
                Number(
                    loanAmount.dataset.maxLoan || 3000
                );


            if (amount > maxLoan) {

                Swal.fire({
                    icon: "warning",
                    title: "Maximum Loan Amount",
                    text:
                        "New applicants can borrow up to ₱" +
                        maxLoan.toLocaleString("en-PH") +
                        " only.",
                    confirmButtonText: "Okay",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                }).then(function () {

                    loanAmount.focus();

                });


                return false;

            }

        }


        /* =================================================
           STEP 2 — LOAN PURPOSE
        ================================================== */

        if (currentStep === 2) {

            if (
                !loanPurpose ||
                !loanPurpose.value
            ) {

                Swal.fire({
                    icon: "warning",
                    title: "Loan Purpose Required",
                    text:
                        "Please select the purpose of your loan before continuing.",
                    confirmButtonText: "Okay",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                }).then(function () {

                    if (loanPurpose) {
                        loanPurpose.focus();
                    }

                });


                return false;

            }

        }


        /* =================================================
           STEP 3 — KASULATAN
        ================================================== */

        if (currentStep === 3) {

            if (
                !kasulatanFile ||
                !kasulatanFile.files ||
                kasulatanFile.files.length === 0
            ) {

                Swal.fire({
                    icon: "warning",
                    title: "Kasulatan Required",
                    text:
                        "Please upload your Kasulatan na Nangangako before continuing.",
                    confirmButtonText: "Okay",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                });


                return false;

            }


            const file =
                kasulatanFile.files[0];

            const maxFileSize =
                5 * 1024 * 1024;


            if (file.size > maxFileSize) {

                Swal.fire({
                    icon: "error",
                    title: "File Too Large",
                    text:
                        "Your Kasulatan must not exceed 5MB.",
                    confirmButtonText:
                        "Choose Another File",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                });


                kasulatanFile.value = "";


                if (fileNameText) {

                    fileNameText.textContent =
                        "Drag and drop your file here, or click to browse.";

                }


                if (summaryKasulatan) {

                    summaryKasulatan.textContent =
                        "Not uploaded";

                }


                return false;

            }

        }


        /* =================================================
           STEP 4 — REPAYMENT
        ================================================== */

        if (currentStep === 4) {

            const selectedRepayment =
                document.querySelector(
                    'input[name="repayment_schedule"]:checked'
                );


            if (!selectedRepayment) {

                Swal.fire({
                    icon: "warning",
                    title: "Repayment Schedule Required",
                    text:
                        "Please select your preferred repayment schedule.",
                    confirmButtonText: "Okay",
                    confirmButtonColor: "#062347",
                    customClass: {
                        popup: "utangwise-alert"
                    }
                });


                return false;

            }

        }


        return true;

    }


    /* =====================================================
       NEXT BUTTON
    ====================================================== */

    if (nextButton) {

        nextButton.addEventListener(
            "click",
            function () {

                if (!validateCurrentStep()) {
                    return;
                }


                if (currentStep < 4) {

                    showStep(
                        currentStep + 1
                    );

                }

            }
        );

    }


    /* =====================================================
       BACK BUTTON
    ====================================================== */

    if (backButton) {

        backButton.addEventListener(
            "click",
            function () {

                if (currentStep > 1) {

                    showStep(
                        currentStep - 1
                    );

                }

            }
        );

    }


    /* =====================================================
       CANCEL BUTTON
    ====================================================== */

    if (cancelButton) {

        cancelButton.addEventListener(
            "click",
            function () {

                Swal.fire({

                    icon: "question",

                    title:
                        "Cancel Loan Request?",

                    text:
                        "The information you entered will not be submitted.",

                    showCancelButton: true,

                    confirmButtonText:
                        "Yes, Cancel",

                    cancelButtonText:
                        "Continue Request",

                    confirmButtonColor:
                        "#062347",

                    cancelButtonColor:
                        "#e5a129",

                    customClass: {
                        popup: "utangwise-alert"
                    }

                }).then(function (result) {

                    if (result.isConfirmed) {

                        window.location.href =
                            "client-dashboard.php";

                    }

                });

            }
        );

    }


    /* =====================================================
       AMOUNT SUMMARY
    ====================================================== */

    if (
        loanAmount &&
        summaryAmount
    ) {

        loanAmount.addEventListener(
            "input",
            function () {

                const amount =
                    Number(loanAmount.value);


                if (
                    loanAmount.value &&
                    amount > 0
                ) {

                    summaryAmount.textContent =
                        amount.toLocaleString(
                            "en-PH",
                            {
                                style: "currency",
                                currency: "PHP"
                            }
                        );

                } else {

                    summaryAmount.textContent =
                        "₱0.00";

                }

            }
        );

    }


    /* =====================================================
       LOAN PURPOSE
    ====================================================== */

    if (
        loanPurpose &&
        summaryPurpose
    ) {

        loanPurpose.addEventListener(
            "change",
            function () {

                summaryPurpose.textContent =
                    loanPurpose.value ||
                    "Not selected";

            }
        );

    }


    /* =====================================================
       PURPOSE DETAILS CHARACTER COUNTER
    ====================================================== */

    if (
        purposeDetails &&
        purposeCharacterCount
    ) {

        purposeDetails.addEventListener(
            "input",
            function () {

                purposeCharacterCount.textContent =
                    purposeDetails.value.length;

            }
        );

    }


    /* =====================================================
       KASULATAN FILE
    ====================================================== */

    if (kasulatanFile) {

        kasulatanFile.addEventListener(
            "change",
            function () {

                if (
                    !kasulatanFile.files ||
                    !kasulatanFile.files.length
                ) {

                    if (fileNameText) {

                        fileNameText.textContent =
                            "Drag and drop your file here, or click to browse.";

                    }


                    if (summaryKasulatan) {

                        summaryKasulatan.textContent =
                            "Not uploaded";

                    }


                    return;

                }


                const file =
                    kasulatanFile.files[0];


                const maxFileSize =
                    5 * 1024 * 1024;


                if (file.size > maxFileSize) {

                    Swal.fire({
                        icon: "error",
                        title: "File Too Large",
                        text:
                            "Please choose a file smaller than 5MB.",
                        confirmButtonText: "Okay",
                        confirmButtonColor: "#062347",
                        customClass: {
                            popup: "utangwise-alert"
                        }
                    });


                    kasulatanFile.value = "";


                    if (fileNameText) {

                        fileNameText.textContent =
                            "Drag and drop your file here, or click to browse.";

                    }


                    if (summaryKasulatan) {

                        summaryKasulatan.textContent =
                            "Not uploaded";

                    }


                    return;

                }


                if (fileNameText) {

                    fileNameText.textContent =
                        file.name;

                }


                if (summaryKasulatan) {

                    summaryKasulatan.textContent =
                        "Uploaded";

                }

            }
        );

    }


    /* =====================================================
       REPAYMENT SUMMARY
    ====================================================== */

    repaymentOptions.forEach(
        function (option) {

            option.addEventListener(
                "change",
                function () {

                    if (!summaryRepayment) {
                        return;
                    }


                    /*
                     * If your radio input has:
                     * data-label="3 Months"
                     *
                     * that value will be shown.
                     *
                     * Otherwise its normal value is shown.
                     */

                    summaryRepayment.textContent =
                        option.dataset.label ||
                        option.value;

                }
            );

        }
    );


    /* =====================================================
       FORM SUBMIT
    ====================================================== */

    if (form) {

        form.addEventListener(
            "submit",
            function (event) {

                event.preventDefault();


                if (!validateCurrentStep()) {
                    return;
                }


                const selectedRepayment =
                    document.querySelector(
                        'input[name="repayment_schedule"]:checked'
                    );


                const repaymentText =
                    selectedRepayment
                        ? (
                            selectedRepayment.dataset.label ||
                            selectedRepayment.value
                        )
                        : "Not selected";


                Swal.fire({

                    icon: "question",

                    title:
                        "Submit Loan Request?",

                    html:
                        `
                        <div style="
                            text-align:left;
                            line-height:1.8;
                            font-size:14px;
                        ">

                            <strong>Amount:</strong>
                            ${summaryAmount
                                ? summaryAmount.textContent
                                : "₱0.00"}

                            <br>

                            <strong>Loan Purpose:</strong>
                            ${summaryPurpose
                                ? summaryPurpose.textContent
                                : "Not selected"}

                            <br>

                            <strong>Kasulatan:</strong>
                            ${summaryKasulatan
                                ? summaryKasulatan.textContent
                                : "Not uploaded"}

                            <br>

                            <strong>Repayment:</strong>
                            ${repaymentText}

                        </div>
                        `,

                    showCancelButton: true,

                    confirmButtonText:
                        "Submit Request",

                    cancelButtonText:
                        "Review",

                    confirmButtonColor:
                        "#e5a129",

                    cancelButtonColor:
                        "#062347",

                    customClass: {
                        popup: "utangwise-alert"
                    }

                }).then(function (result) {

                    if (result.isConfirmed) {

                        /*
                         * IMPORTANT:
                         * Remove preventDefault above OR
                         * use form.submit() here once your
                         * backend/database submission is ready.
                         */

                        form.submit();

                    }

                });

            }
        );

    }


    /* =====================================================
       INITIAL PAGE
    ====================================================== */

    showStep(1);

});