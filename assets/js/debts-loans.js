document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const modal =
        document.getElementById("loanModal");

    const closeX =
        document.getElementById("closeLoanModal");

    const closeButton =
        document.getElementById("modalCloseButton");

    const searchInput =
        document.getElementById("loanSearch");

    const statusFilter =
        document.getElementById("statusFilter");

    const termFilter =
        document.getElementById("termFilter");

    const resetFilters =
        document.getElementById("resetFilters");


    /* =====================================================
       TEMPORARY LOAN DATA

       Later, replace with database data.
    ===================================================== */

    const loans = {

        maria: {
            initials: "MS",
            borrower: "Maria Santos",
            loanId: "LN-2026-001",

            status: "Active",
            type: "Personal Loan",

            granted: "Jan 15, 2026",

            amount: "₱3,000",
            paid: "₱550",
            balance: "₱2,450",

            term: "3 Months",
            interest: "5%",

            monthly: "₱550",

            start: "Jan 15, 2026",
            originalDue: "Apr 15, 2026",
            nextDue: "Mar 15, 2026",

            percent: 18,

            agreement:
                "Loan Agreement.pdf",

            agreementDate:
                "Uploaded on Jan 15, 2026",

            schedule: [

                {
                    due: "Feb 15, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Paid"
                },

                {
                    due: "Mar 15, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Upcoming"
                },

                {
                    due: "Apr 15, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Pending"
                }

            ]

        },


        juan: {
            initials: "JD",
            borrower: "Juan Dela Cruz",
            loanId: "LN-2026-002",

            status: "Active",
            type: "Personal Loan",

            granted: "Jan 20, 2026",

            amount: "₱2,500",
            paid: "₱1,200",
            balance: "₱1,300",

            term: "6 Months",
            interest: "5%",

            monthly: "₱440",

            start: "Jan 20, 2026",
            originalDue: "Jul 20, 2026",
            nextDue: "Mar 20, 2026",

            percent: 48,

            agreement:
                "Loan Agreement.pdf",

            agreementDate:
                "Uploaded on Jan 20, 2026",

            schedule: [

                {
                    due: "Feb 20, 2026",
                    amount: "₱440",
                    principal: "₱420",
                    interest: "₱20",
                    status: "Paid"
                },

                {
                    due: "Mar 20, 2026",
                    amount: "₱440",
                    principal: "₱420",
                    interest: "₱20",
                    status: "Upcoming"
                },

                {
                    due: "Apr 20, 2026",
                    amount: "₱440",
                    principal: "₱420",
                    interest: "₱20",
                    status: "Pending"
                }

            ]

        },


        ana: {
            initials: "AC",
            borrower: "Ana Cruz",
            loanId: "LN-2026-003",

            status: "Overdue",
            type: "Personal Loan",

            granted: "Dec 25, 2025",

            amount: "₱3,000",
            paid: "₱1,100",
            balance: "₱1,900",

            term: "6 Months",
            interest: "5%",

            monthly: "₱550",

            start: "Dec 25, 2025",
            originalDue: "Jun 25, 2026",
            nextDue: "Feb 25, 2026",

            percent: 37,

            agreement:
                "Loan Agreement.pdf",

            agreementDate:
                "Uploaded on Dec 25, 2025",

            schedule: [

                {
                    due: "Jan 25, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Paid"
                },

                {
                    due: "Feb 25, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Overdue"
                },

                {
                    due: "Mar 25, 2026",
                    amount: "₱550",
                    principal: "₱523",
                    interest: "₱27",
                    status: "Pending"
                }

            ]

        },


        pedro: {
            initials: "PR",
            borrower: "Pedro Reyes",
            loanId: "LN-2026-004",

            status: "Completed",
            type: "Personal Loan",

            granted: "Nov 10, 2025",

            amount: "₱2,000",
            paid: "₱2,000",
            balance: "₱0",

            term: "3 Months",
            interest: "5%",

            monthly: "₱700",

            start: "Nov 10, 2025",
            originalDue: "Feb 10, 2026",
            nextDue: "—",

            percent: 100,

            agreement:
                "Loan Agreement.pdf",

            agreementDate:
                "Uploaded on Nov 10, 2025",

            schedule: [

                {
                    due: "Dec 10, 2025",
                    amount: "₱700",
                    principal: "₱667",
                    interest: "₱33",
                    status: "Paid"
                },

                {
                    due: "Jan 10, 2026",
                    amount: "₱700",
                    principal: "₱667",
                    interest: "₱33",
                    status: "Paid"
                },

                {
                    due: "Feb 10, 2026",
                    amount: "₱700",
                    principal: "₱666",
                    interest: "₱34",
                    status: "Paid"
                }

            ]

        }

    };


    /* =====================================================
       DATATABLE
    ===================================================== */

    let loansTable = null;


    if (
        document.getElementById("loansTable") &&
        typeof DataTable !== "undefined"
    ) {

        loansTable =
            new DataTable("#loansTable", {

                pageLength: 10,

                lengthMenu: [
                    5,
                    10,
                    25,
                    50
                ],

                order: [
                    [7, "asc"]
                ],

                columnDefs: [
                    {
                        targets: 9,
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {

                    search: "",

                    lengthMenu:
                        "Show _MENU_ entries",

                    info:
                        "Showing _START_ to _END_ of _TOTAL_ loans",

                    infoEmpty:
                        "No loans available",

                    zeroRecords:
                        "No matching loans found",

                    paginate: {
                        previous: "‹",
                        next: "›"
                    }

                }

            });

    }


    /* =====================================================
       CUSTOM SEARCH
    ===================================================== */

    if (
        searchInput &&
        loansTable
    ) {

        searchInput.addEventListener(
            "input",
            function () {

                loansTable
                    .search(searchInput.value)
                    .draw();

            }
        );

    }


    /* =====================================================
       STATUS FILTER
       COLUMN 8
    ===================================================== */

    if (
        statusFilter &&
        loansTable
    ) {

        statusFilter.addEventListener(
            "change",
            function () {

                const value =
                    statusFilter.value;


                loansTable
                    .column(8)
                    .search(
                        value
                            ? "^" +
                              escapeRegex(value) +
                              "$"
                            : "",
                        true,
                        false
                    )
                    .draw();

            }
        );

    }


    /* =====================================================
       TERM FILTER
       COLUMN 6
    ===================================================== */

    if (
        termFilter &&
        loansTable
    ) {

        termFilter.addEventListener(
            "change",
            function () {

                const value =
                    termFilter.value;


                loansTable
                    .column(6)
                    .search(
                        value
                            ? "^" +
                              escapeRegex(value) +
                              "$"
                            : "",
                        true,
                        false
                    )
                    .draw();

            }
        );

    }


    /* =====================================================
       RESET FILTERS
    ===================================================== */

    if (
        resetFilters &&
        loansTable
    ) {

        resetFilters.addEventListener(
            "click",
            function () {

                searchInput.value = "";
                statusFilter.value = "";
                termFilter.value = "";

                loansTable.search("");

                loansTable
                    .columns()
                    .search("");

                loansTable.draw();

            }
        );

    }


    function escapeRegex(value) {

        return value.replace(
            /[.*+?^${}()|[\]\\]/g,
            "\\$&"
        );

    }


    /* =====================================================
       VIEW LOAN
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const button =
                event.target.closest(
                    ".view-loan-btn"
                );


            if (!button) {
                return;
            }


            const key =
                button.dataset.loan;


            const loan =
                loans[key];


            if (!loan) {
                return;
            }


            populateLoanModal(loan);

            openModal();

        }
    );


    /* =====================================================
       POPULATE MODAL
    ===================================================== */

    function populateLoanModal(loan) {

        setText(
            "modalAvatar",
            loan.initials
        );

        setText(
            "modalBorrower",
            loan.borrower
        );

        setText(
            "modalLoanId",
            loan.loanId
        );

        setText(
            "modalLoanType",
            loan.type
        );

        setText(
            "modalGranted",
            loan.granted
        );

        setText(
            "modalAmount",
            loan.amount
        );

        setText(
            "modalTerm",
            loan.term
        );

        setText(
            "modalInterest",
            loan.interest
        );

        setText(
            "modalMonthly",
            loan.monthly
        );

        setText(
            "modalStart",
            loan.start
        );

        setText(
            "modalOriginalDue",
            loan.originalDue
        );

        setText(
            "modalNextDue",
            loan.nextDue
        );

        setText(
            "modalTotal",
            loan.amount
        );

        setText(
            "modalPaid",
            loan.paid
        );

        setText(
            "modalBalance",
            loan.balance
        );

        setText(
            "modalPercent",
            loan.percent + "%"
        );

        setText(
            "modalNextPayment",
            loan.nextDue
        );

        setText(
            "modalNextAmount",
            loan.status === "Completed"
                ? "—"
                : loan.monthly
        );

        setText(
            "modalAgreementName",
            loan.agreement
        );

        setText(
            "modalAgreementDate",
            loan.agreementDate
        );


        /* STATUS */

        const status =
            document.getElementById(
                "modalStatus"
            );


        if (status) {

            status.textContent =
                loan.status;


            status.classList.remove(
                "active",
                "overdue",
                "completed"
            );


            status.classList.add(
                loan.status.toLowerCase()
            );

        }


        /* PROGRESS CIRCLE */

        const progressCircle =
            document.querySelector(
                ".progress-circle"
            );


        if (progressCircle) {

            const degrees =
                Math.min(
                    Math.max(
                        loan.percent,
                        0
                    ),
                    100
                ) * 3.6;


            progressCircle.style.background =
                `conic-gradient(
                    #e5a129 0deg ${degrees}deg,
                    #e2e7ee ${degrees}deg 360deg
                )`;

        }


        /* PAYMENT SCHEDULE */

        populateSchedule(
            loan.schedule
        );

    }


    /* =====================================================
       PAYMENT SCHEDULE
    ===================================================== */

    function populateSchedule(schedule) {

        const body =
            document.getElementById(
                "paymentScheduleBody"
            );


        if (!body) {
            return;
        }


        body.innerHTML = "";


        schedule.forEach(
            function (payment, index) {

                const row =
                    document.createElement(
                        "tr"
                    );


                const statusClass =
                    payment.status
                        .toLowerCase();


                row.innerHTML = `
                    <td>${index + 1}</td>

                    <td>
                        ${payment.due}
                    </td>

                    <td>
                        ${payment.amount}
                    </td>

                    <td>
                        ${payment.principal}
                    </td>

                    <td>
                        ${payment.interest}
                    </td>

                    <td>
                        <span
                            class="payment-status ${statusClass}"
                        >
                            ${payment.status}
                        </span>
                    </td>
                `;


                body.appendChild(row);

            }
        );

    }


    /* =====================================================
       HELPER
    ===================================================== */

    function setText(id, value) {

        const element =
            document.getElementById(id);


        if (element) {

            element.textContent =
                value;

        }

    }


    /* =====================================================
       OPEN MODAL
    ===================================================== */

    function openModal() {

        if (!modal) {
            return;
        }


        modal.classList.add(
            "show"
        );


        modal.setAttribute(
            "aria-hidden",
            "false"
        );


        document.body.style.overflow =
            "hidden";

    }


    /* =====================================================
       CLOSE MODAL
    ===================================================== */

    function closeModal() {

        if (!modal) {
            return;
        }


        modal.classList.remove(
            "show"
        );


        modal.setAttribute(
            "aria-hidden",
            "true"
        );


        document.body.style.overflow =
            "";

    }


    if (closeX) {

        closeX.addEventListener(
            "click",
            closeModal
        );

    }


    if (closeButton) {

        closeButton.addEventListener(
            "click",
            closeModal
        );

    }


    /* =====================================================
       CLICK OUTSIDE MODAL
    ===================================================== */

    if (modal) {

        modal.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === modal
                ) {

                    closeModal();

                }

            }
        );

    }


    /* =====================================================
       ESC CLOSE
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                modal &&
                modal.classList.contains(
                    "show"
                )
            ) {

                closeModal();

            }

        }
    );


    /* =====================================================
       VIEW AGREEMENT

       Temporary front-end only.
       Later connect this to the actual uploaded PDF.
    ===================================================== */

    const viewAgreement =
        document.getElementById(
            "viewAgreement"
        );


    if (viewAgreement) {

        viewAgreement.addEventListener(
            "click",
            function () {

                /*
                    BACKEND VERSION LATER:

                    window.open(
                        loan.agreement_path,
                        "_blank"
                    );
                */

                console.log(
                    "Open signed loan agreement."
                );

            }
        );

    }

});