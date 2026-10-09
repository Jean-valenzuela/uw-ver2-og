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
       DATATABLE
    ========================================= */

    let paymentTable = null;

    const paymentTableElement =
        document.getElementById("paymentTable");


    if (
        paymentTableElement &&
        typeof DataTable !== "undefined"
    ) {

        paymentTable = new DataTable("#paymentTable", {

            pageLength: 10,

            lengthMenu: [5, 10, 25, 50],

            /*
             * Payment Date column
             */
            order: [[1, "desc"]],

            /*
             * Action column should not be sortable.
             */
            columnDefs: [
                {
                    targets: 7,
                    orderable: false,
                    searchable: false
                }
            ],

            language: {

                search: "",

                searchPlaceholder:
                    "Search payments...",

                lengthMenu:
                    "Show _MENU_ entries",

                info:
                    "Showing _START_ to _END_ of _TOTAL_ payments",

                infoEmpty:
                    "No payments available",

                zeroRecords:
                    "No matching payments found",

                paginate: {
                    first: "«",
                    previous: "‹",
                    next: "›",
                    last: "»"
                }

            }

        });

    }


    /* =========================================
       CUSTOM FILTERS
    ========================================= */

    const filterBtn =
        document.getElementById("filterBtn");

    const loanFilter =
        document.getElementById("loanFilter");

    const methodFilter =
        document.getElementById("methodFilter");

    const statusFilter =
        document.getElementById("statusFilter");


    if (
        filterBtn &&
        paymentTable
    ) {

        filterBtn.addEventListener("click", function () {

            /*
             * COLUMN INDEXES:
             *
             * 0 = #
             * 1 = Payment Date
             * 2 = Loan ID
             * 3 = Amount Paid
             * 4 = Payment Method
             * 5 = Reference No.
             * 6 = Status
             * 7 = Actions
             */


            /* LOAN ID */

            if (loanFilter.value) {

                paymentTable
                    .column(2)
                    .search(
                        "^" +
                        escapeRegex(loanFilter.value) +
                        "$",
                        true,
                        false
                    );

            } else {

                paymentTable
                    .column(2)
                    .search("");

            }


            /* PAYMENT METHOD */

            if (methodFilter.value) {

                paymentTable
                    .column(4)
                    .search(
                        "^" +
                        escapeRegex(methodFilter.value) +
                        "$",
                        true,
                        false
                    );

            } else {

                paymentTable
                    .column(4)
                    .search("");

            }


            /* STATUS */

            if (statusFilter.value) {

                paymentTable
                    .column(6)
                    .search(
                        "^" +
                        escapeRegex(statusFilter.value) +
                        "$",
                        true,
                        false
                    );

            } else {

                paymentTable
                    .column(6)
                    .search("");

            }


            paymentTable.draw();

        });

    }


    /* =========================================
       ESCAPE DATATABLE REGEX
    ========================================= */

    function escapeRegex(value) {

        return value.replace(
            /[.*+?^${}()|[\]\\]/g,
            "\\$&"
        );

    }


    /* =========================================
       PAYMENT DETAILS MODAL
    ========================================= */

    const modal =
        document.getElementById("paymentModal");

    const closeButtons =
        document.querySelectorAll(
            "[data-close-payment-modal]"
        );


    function openPaymentModal(index) {

        if (
            !modal ||
            !window.paymentHistoryData
        ) {
            return;
        }


        const payment =
            window.paymentHistoryData[index];


        if (!payment) {
            return;
        }


        document.getElementById(
            "modalDate"
        ).textContent =
            payment.date;


        document.getElementById(
            "modalLoan"
        ).textContent =
            payment.loan_id;


        document.getElementById(
            "modalAmount"
        ).textContent =
            payment.amount;


        document.getElementById(
            "modalMethod"
        ).textContent =
            payment.method;


        document.getElementById(
            "modalReference"
        ).textContent =
            payment.reference;


        document.getElementById(
            "modalStatus"
        ).textContent =
            payment.status;


        modal.classList.add("show");

        modal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "modal-open"
        );

    }


    /*
     * IMPORTANT:
     *
     * DataTables redraws rows during searching,
     * sorting and pagination.
     *
     * So instead of attaching click listeners
     * directly to every View button, we use
     * event delegation.
     */

    document.addEventListener("click", function (event) {

        const viewButton =
            event.target.closest(".view-btn");


        if (!viewButton) {
            return;
        }


        openPaymentModal(
            viewButton.dataset.paymentIndex
        );

    });


    function closePaymentModal() {

        if (!modal) {
            return;
        }


        modal.classList.remove("show");

        modal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "modal-open"
        );

    }


    closeButtons.forEach(function (button) {

        button.addEventListener(
            "click",
            closePaymentModal
        );

    });


    document.addEventListener("keydown", function (event) {

        if (
            event.key === "Escape" &&
            modal &&
            modal.classList.contains("show")
        ) {

            closePaymentModal();

        }

    });


    /* =========================================
       DOWNLOAD PDF
       TEMPORARY FRONT-END BUTTON
    ========================================= */

    const downloadPdfBtn =
        document.getElementById("downloadPdfBtn");


    if (downloadPdfBtn) {

        downloadPdfBtn.addEventListener(
            "click",
            function () {

                alert(
                    "PDF generation will be connected " +
                    "to the backend later."
                );

            }
        );

    }

});