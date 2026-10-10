
document.addEventListener("DOMContentLoaded", () => {

    // =====================================
    // MOBILE SIDEBAR
    // =====================================

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const menuButton = document.getElementById("mobileMenuBtn");

    function closeMenu() {
        if (!sidebar || !overlay || !menuButton) {
            return;
        }

        sidebar.classList.remove("open");
        overlay.classList.remove("show");
        menuButton.setAttribute("aria-expanded", "false");
    }

    if (sidebar && overlay && menuButton) {

        menuButton.addEventListener("click", () => {

            const isOpen = sidebar.classList.toggle("open");

            overlay.classList.toggle("show", isOpen);

            menuButton.setAttribute(
                "aria-expanded",
                String(isOpen)
            );
        });

        overlay.addEventListener("click", closeMenu);
    }

    // =====================================
    // APPROVED LENDERS DATA
    // =====================================

    const lendersData = document.getElementById("lendersData");

    const lenders = JSON.parse(
        lendersData.textContent
    );

    const lenderById = new Map(
        lenders.map(lender => [
            String(lender.id),
            lender
        ])
    );

    // =====================================
    // DATATABLE INITIALIZATION
    // =====================================

    if (window.jQuery && jQuery.fn.DataTable) {

        const table = new DataTable("#approvedLendersTable", {

            pageLength: 10,

            lengthChange: false,

            searching: true,

            ordering: true,

            order: [[0, "asc"]],

            columnDefs: [
                {
                    targets: 7,
                    orderable: false,
                    searchable: false
                }
            ],

            layout: {
                topStart: null,
                topEnd: null,
                bottomStart: "info",
                bottomEnd: "paging"
            },

            language: {
                info: "Showing _START_ to _END_ of _TOTAL_ approved lenders",
                infoEmpty: "Showing 0 approved lenders",
                emptyTable: "No approved lenders found."
            }
        });

        // ENTRIES PER PAGE
        const pageLength = document.getElementById("pageLength");

        if (pageLength) {
            pageLength.addEventListener("change", event => {
                table.page.len(Number(event.target.value)).draw();
            });
        }

        // SEARCH
        const lenderSearch = document.getElementById("lenderSearch");

        if (lenderSearch) {
            lenderSearch.addEventListener("input", event => {
                table.search(event.target.value).draw();
            });
        }

    } else {
        console.error("DataTables library is not loaded.");
    }

    // =====================================
    // MODAL ELEMENTS
    // =====================================

    const modal = document.getElementById("lenderDetailsModal");
    const modalPanel = modal.querySelector(".lender-details-modal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    const applicationToggle = document.getElementById("applicationToggle");
    const applicationContent = document.getElementById("applicationContent");

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

        if (value === null || value === undefined || value === "") {
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

        // Only display trusted URLs provided by your backend.
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
    // OPEN LENDER DETAILS MODAL
    // =====================================

    function openModal(lender, trigger) {

        previousFocus = trigger;

        put("modalName", lender.name);
        put("modalEmail", lender.email);
        put("modalPhone", lender.phone);

        put("modalFunds", lender.source_of_funds);
        put("modalLimit", formatPesos(lender.limit));
        put("modalReason", lender.lender_reason);
        put("modalBorrowers", lender.number_of_borrowers);

        setDocument("modalSourceProof", lender.source_proof);
        setDocument("modalValidId", lender.valid_id);

        // Reset application section.
        applicationContent.hidden = false;
        applicationToggle.setAttribute("aria-expanded", "true");

        applicationToggle.querySelector(
            ".material-symbols-outlined"
        ).textContent = "keyboard_arrow_up";

        modal.hidden = false;
        document.body.classList.add("modal-open");

        modalPanel.focus();
    }

    // =====================================
    // CLOSE LENDER DETAILS MODAL
    // =====================================

    function closeModal() {

        if (modal.hidden) {
            return;
        }

        modal.hidden = true;
        document.body.classList.remove("modal-open");

        if (previousFocus && previousFocus.isConnected) {
            previousFocus.focus();
        }
    }

    // =====================================
    // VIEW DETAILS BUTTON
    // =====================================

    document
        .getElementById("approvedLendersTable")
        .addEventListener("click", event => {

            const button = event.target.closest(".view-details");

            if (!button) {
                return;
            }

            const lender = lenderById.get(
                button.dataset.id
            );

            if (lender) {
                openModal(lender, button);
            }
        });

    // =====================================
    // CLOSE MODAL EVENTS
    // =====================================

    closeModalBtn.addEventListener("click", closeModal);

    modal.addEventListener("click", event => {

        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener("keydown", event => {

        if (event.key === "Escape") {

            if (!modal.hidden) {
                closeModal();
            } else {
                closeMenu();
            }
        }

        // Keep keyboard focus inside the popup.
        if (event.key === "Tab" && !modal.hidden) {

            const focusable = [
                ...modal.querySelectorAll(
                    'button:not([disabled]):not([hidden]), a[href]'
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
    // APPLICATION EXPAND / COLLAPSE
    // =====================================

    applicationToggle.addEventListener("click", () => {

        const isExpanded =
            applicationToggle.getAttribute("aria-expanded") === "true";

        applicationContent.hidden = isExpanded;

        applicationToggle.setAttribute(
            "aria-expanded",
            String(!isExpanded)
        );

        applicationToggle.querySelector(
            ".material-symbols-outlined"
        ).textContent = isExpanded
            ? "keyboard_arrow_down"
            : "keyboard_arrow_up";
    });

    // =====================================
    // DELETE LENDER CONFIRMATION
    // =====================================

    document.addEventListener("click", async event => {

        const deleteButton = event.target.closest(".delete-btn");

        if (!deleteButton) {
            return;
        }

        const lenderName = deleteButton.dataset.name;

        const result = await Swal.fire({

            title: "Delete Lender?",

            text: `Are you sure you want to delete ${lenderName}?`,

            icon: "warning",

            showCancelButton: true,

            confirmButtonText: "Yes, Delete",

            cancelButtonText: "Cancel",

            confirmButtonColor: "#e12c3a",

            cancelButtonColor: "#062347",

            reverseButtons: true
        });

        if (result.isConfirmed) {


            await Swal.fire({
                title: "Deleted",
                text: "The lender has been deleted.",
                icon: "success",
                confirmButtonColor: "#062347"
            });
        }
    });

});
