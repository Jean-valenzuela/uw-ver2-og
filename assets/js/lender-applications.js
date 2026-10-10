
document.addEventListener("DOMContentLoaded", () => {

    // =====================================
    // MOBILE SIDEBAR
    // =====================================

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const menuButton = document.getElementById("mobileMenuBtn");

    function closeMenu() {
        sidebar.classList.remove("open");
        overlay.classList.remove("show");
        menuButton.setAttribute("aria-expanded", "false");
    }

    menuButton.addEventListener("click", () => {
        const isOpen = sidebar.classList.toggle("open");

        overlay.classList.toggle("show", isOpen);

        menuButton.setAttribute(
            "aria-expanded",
            String(isOpen)
        );
    });

    overlay.addEventListener("click", closeMenu);

    // =====================================
    // APPLICANT DATA
    // =====================================

    const applicants = JSON.parse(
        document.getElementById("applicantsData").textContent
    );

    const applicantById = new Map(
        applicants.map(applicant => [
            String(applicant.id),
            applicant
        ])
    );

    // =====================================
    // DATATABLES
    // =====================================

    const table = new DataTable("#applicationsTable", {
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        order: [[3, "desc"]],

        columnDefs: [
            {
                targets: 5,
                orderable: false,
                searchable: false
            }
        ],

        language: {
            search: "Search:",
            searchPlaceholder: "Search applicants..."
        }
    });

    // =====================================
    // STATUS FILTERS
    // =====================================

    const filterButtons = document.querySelectorAll(".filter-btn");

    filterButtons.forEach(button => {

        button.addEventListener("click", () => {

            filterButtons.forEach(item => {
                item.classList.remove("active");
                item.setAttribute("aria-pressed", "false");
            });

            button.classList.add("active");
            button.setAttribute("aria-pressed", "true");

            const selectedStatus = button.dataset.status;

            table
                .column(4)
                .search(
                    selectedStatus === "All" ? "" : selectedStatus,
                    { exact: true }
                )
                .draw();
        });
    });

    // =====================================
    // MODAL ELEMENTS
    // =====================================

    const modal = document.getElementById("applicationModal");
    const modalPanel = modal.querySelector(".application-modal");
    const closeButton = document.getElementById("closeModalBtn");

    const reviewNote = document.getElementById("reviewNote");
    const reviewActions = document.getElementById("reviewActions");
    const reviewCompleted = document.getElementById("reviewCompleted");

    let selectedApplicant = null;
    let previousFocus = null;

    // =====================================
    // HELPER FUNCTIONS
    // =====================================

    function put(id, value) {
        document.getElementById(id).textContent =
            value === null || value === undefined || value === ""
                ? "—"
                : String(value);
    }

    function formatPesos(value) {
        if (value === null || value === undefined) {
            return "—";
        }

        return new Intl.NumberFormat("en-PH", {
            style: "currency",
            currency: "PHP"
        }).format(Number(value));
    }

    function setDocument(id, url) {
        const target = document.getElementById(id);

        target.replaceChildren();

        // Only use trusted document URLs from your backend.
        const isValidUrl =
            typeof url === "string" &&
            (
                /^https?:\/\//i.test(url) ||
                /^(?:\/|\.\.?\/)/.test(url)
            );

        if (!isValidUrl) {
            target.textContent = "No file linked";
            return;
        }

        const link = document.createElement("a");

        link.href = url;
        link.target = "_blank";
        link.rel = "noopener noreferrer";
        link.textContent = "View File";

        target.appendChild(link);
    }

    // =====================================
    // OPEN APPLICATION MODAL
    // =====================================

    function openModal(applicant, trigger) {

        selectedApplicant = applicant;
        previousFocus = trigger;

        put("modalName", applicant.name);
        put("modalEmail", applicant.email);
        put("modalPhone", applicant.phone);
        put("modalFunds", applicant.source_of_funds);
        put("modalLimit", formatPesos(applicant.lending_limit));
        put("modalReason", applicant.lender_reason);

        setDocument("modalSourceProof", applicant.source_proof);
        setDocument("modalValidId", applicant.valid_id);

        const status = String(
            applicant.status || "Pending"
        ).toLowerCase();

        const statusBadge = document.getElementById("modalStatus");

        const allowedStatuses = [
            "pending",
            "approved",
            "rejected"
        ];

        statusBadge.className =
            "application-status status-" +
            (allowedStatuses.includes(status) ? status : "pending");

        statusBadge.textContent = applicant.status || "Pending";

        reviewNote.value = "";

        const isPending = status === "pending";

        reviewActions.hidden = !isPending;
        reviewNote.hidden = !isPending;

        document.querySelector(
            ".review-section label"
        ).hidden = !isPending;

        reviewCompleted.hidden = isPending;

        reviewCompleted.textContent = isPending
            ? ""
            : `This application is ${status}.`;

        modal.hidden = false;
        document.body.classList.add("modal-open");

        modalPanel.focus();
    }

    // =====================================
    // CLOSE APPLICATION MODAL
    // =====================================

    function closeModal() {

        if (modal.hidden) {
            return;
        }

        if (
            reviewNote.value.trim() &&
            !window.confirm(
                "Close without saving your review note?"
            )
        ) {
            return;
        }

        modal.hidden = true;
        document.body.classList.remove("modal-open");

        selectedApplicant = null;

        if (previousFocus && previousFocus.isConnected) {
            previousFocus.focus();
        }
    }

    // =====================================
    // VIEW BUTTON
    // =====================================

    document
        .getElementById("applicationsTable")
        .addEventListener("click", event => {

            const button = event.target.closest(".view-btn");

            if (!button) {
                return;
            }

            const applicant = applicantById.get(
                button.dataset.applicantId
            );

            if (applicant) {
                openModal(applicant, button);
            }
        });

    // =====================================
    // CLOSE EVENTS
    // =====================================

    closeButton.addEventListener("click", closeModal);

    modal.addEventListener("click", event => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener("keydown", event => {

        if (event.key === "Escape") {

            if (!modal.hidden) {
                event.preventDefault();
                closeModal();
            } else {
                closeMenu();
            }
        }

        // Keep keyboard focus inside the modal.
        if (event.key === "Tab" && !modal.hidden) {

            const focusable = [
                ...modal.querySelectorAll(
                    'button:not([disabled]):not([hidden]), textarea:not([hidden]), a[href]'
                )
            ].filter(element => element.getClientRects().length);

            if (!focusable.length) {
                return;
            }

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (
                !event.shiftKey &&
                document.activeElement === last
            ) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    // =====================================
    // APPROVE APPLICATION
    // =====================================

    document
        .getElementById("approveBtn")
        .addEventListener("click", async () => {

            if (!selectedApplicant) {
                return;
            }

            const result = await Swal.fire({
                title: "Approve Application?",
                text: `Approve ${selectedApplicant.name}?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Approve",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#e5a129",
                cancelButtonColor: "#062347"
            });

            if (result.isConfirmed) {

                // Demo only. Connect existing PHP handler.
                await Swal.fire({
                    title: "Approved",
                    text: "Application approved successfully.",
                    icon: "success",
                    confirmButtonColor: "#062347"
                });
            }
        });

    // =====================================
    // REJECT APPLICATION
    // =====================================

    document
        .getElementById("rejectBtn")
        .addEventListener("click", async () => {

            if (!selectedApplicant) {
                return;
            }

            if (!reviewNote.value.trim()) {

                await Swal.fire({
                    title: "Review Note Required",
                    text: "Enter a reason before rejecting.",
                    icon: "warning",
                    confirmButtonColor: "#062347"
                });

                reviewNote.focus();
                return;
            }

            const result = await Swal.fire({
                title: "Reject Application?",
                text: `Reject ${selectedApplicant.name}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Reject",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#062347"
            });

            if (result.isConfirmed) {

                
                await Swal.fire({
                    title: "Rejected",
                    text: "Application has been rejected.",
                    icon: "error",
                    confirmButtonColor: "#062347"
                });
            }
        });
});
