document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       DATATABLE
    ========================================= */

    const table = new DataTable("#loansTable", {
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        order: [[2, "desc"]],

        columnDefs: [
            {
                targets: 5,
                orderable: false,
                searchable: false
            }
        ],

        language: {
            search: "Search:",
            searchPlaceholder: "Search loans...",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            zeroRecords: "No matching loans found"
        }
    });


    /* =========================================
       STATUS FILTER
    ========================================= */

    const statusFilter = document.getElementById("loanStatusFilter");

    if (statusFilter) {
        statusFilter.addEventListener("change", function () {
            table
                .column(4)
                .search(this.value)
                .draw();
        });
    }


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
    }


    /* =========================================
       LOAN DETAILS MODAL
    ========================================= */

    const modal = document.getElementById("loanDetailsModal");
    const triggers = document.querySelectorAll(".loan-details-trigger");
    const closeButtons = modal.querySelectorAll("[data-close-loan-modal]");

    const loanData = {
        "LN-2025-001": {
            amount: "₱5,000.00",
            granted: "Jul 10, 2025",
            due: "Sep 12, 2025",
            status: "On-going",
            progress: 50
        },

        "LN-2025-002": {
            amount: "₱3,000.00",
            granted: "Mar 15, 2025",
            due: "May 15, 2025",
            status: "Completed",
            progress: 100
        }
    };


    function openModal(id) {

        const data =
            loanData[id] || loanData["LN-2025-001"];

        const completed =
            data.status === "Completed";

        document.getElementById("modalLoanId").textContent = id;
        document.getElementById("modalAmount").textContent = data.amount;
        document.getElementById("modalGranted").textContent = data.granted;
        document.getElementById("modalDue").textContent = data.due;

        document.getElementById("modalGrantedText").textContent =
            "Granted on " + data.granted;


        const status =
            document.getElementById("modalStatus");

        status.className =
            "modal-status " +
            (completed ? "completed" : "ongoing");

        status.innerHTML =
            '<span class="material-symbols-outlined">' +
            (completed ? "check_circle" : "schedule") +
            "</span>" +
            data.status;


        document.getElementById("modalStatusText").textContent =
            completed
                ? "This loan has been fully paid."
                : "You are currently paying this loan.";


        document.getElementById("progressPercent").textContent =
            data.progress + "%";

        document.getElementById("progressBar").style.width =
            data.progress + "%";

        document
            .querySelector(".progress-ring")
            .style
            .setProperty(
                "--progress",
                data.progress * 3.6 + "deg"
            );


        document.getElementById("progressTitle").textContent =
            completed
                ? "6 of 6 payments"
                : "3 of 6 payments";

        document.getElementById("progressRemaining").textContent =
            completed
                ? "All payments completed"
                : "3 payments remaining";

        document.getElementById("progressNoteTitle").textContent =
            completed
                ? "Congratulations!"
                : "Keep up the good work!";

        document.getElementById("progressNoteText").textContent =
            completed
                ? "You have successfully completed this loan."
                : "You're halfway there.";


        document.getElementById("nextPaymentCard").style.display =
            completed ? "none" : "block";


        modal.classList.add("show");
        modal.setAttribute("aria-hidden", "false");

        document.body.classList.add("modal-open");
    }


    function closeModal() {

        modal.classList.remove("show");
        modal.setAttribute("aria-hidden", "true");

        document.body.classList.remove("modal-open");
    }


    /* VIEW DETAILS */

    triggers.forEach(function (button) {

        button.addEventListener("click", function () {

            openModal(button.dataset.loanId);

        });

    });


    /* CLOSE BUTTON */

    closeButtons.forEach(function (button) {

        button.addEventListener(
            "click",
            closeModal
        );

    });


    /* ESCAPE KEY */

    document.addEventListener("keydown", function (event) {

        if (
            event.key === "Escape" &&
            modal.classList.contains("show")
        ) {
            closeModal();
        }

    });

});