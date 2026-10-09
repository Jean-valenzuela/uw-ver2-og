document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const workspace =
        document.getElementById("applicationsWorkspace");

    const drawer =
        document.getElementById("applicantDrawer");

    const closeDrawerButton =
        document.getElementById("closeDrawer");

    const applicantSearch =
        document.getElementById("applicantSearch");

    const statusFilter =
        document.getElementById("statusFilter");

    const termFilter =
        document.getElementById("termFilter");

    const resetFilters =
        document.getElementById("resetFilters");


    /* =====================================================
       SAMPLE APPLICATION DATA

       TEMPORARY FRONT-END DATA.
       Later, replace this with values from the database.
    ===================================================== */

    const applications = {

        maria: {
            initials: "MS",
            name: "Maria Santos",
            applicationId: "APP-2026-001",
            phone: "+63 915 123 4567",
            status: "Pending",
            amount: "₱3,000",
            purpose: "Medical / Emergency",
            term: "3 Months"
        },

        juan: {
            initials: "JD",
            name: "Juan Dela Cruz",
            applicationId: "APP-2026-002",
            phone: "+63 912 345 6789",
            status: "Approved",
            amount: "₱2,500",
            purpose: "Bills / Utilities",
            term: "3 Months"
        },

        ana: {
            initials: "AC",
            name: "Ana Cruz",
            applicationId: "APP-2026-003",
            phone: "+63 918 567 8901",
            status: "Pending",
            amount: "₱3,000",
            purpose: "Education",
            term: "6 Months"
        },

        pedro: {
            initials: "PR",
            name: "Pedro Reyes",
            applicationId: "APP-2026-004",
            phone: "+63 917 456 7890",
            status: "Denied",
            amount: "₱2,000",
            purpose: "Personal Needs",
            term: "1 Month"
        },

        mark: {
            initials: "MR",
            name: "Mark Rivera",
            applicationId: "APP-2026-005",
            phone: "+63 915 222 3456",
            status: "Pending",
            amount: "₱3,000",
            purpose: "Business",
            term: "6 Months"
        },

        liza: {
            initials: "LM",
            name: "Liza Mendoza",
            applicationId: "APP-2026-006",
            phone: "+63 917 888 1234",
            status: "Approved",
            amount: "₱2,500",
            purpose: "Home Expenses",
            term: "3 Months"
        },

        carlo: {
            initials: "CR",
            name: "Carlo Ramirez",
            applicationId: "APP-2026-007",
            phone: "+63 919 333 4455",
            status: "Approved",
            amount: "₱3,000",
            purpose: "Medical / Emergency",
            term: "6 Months"
        },

        rhea: {
            initials: "RF",
            name: "Rhea Flores",
            applicationId: "APP-2026-008",
            phone: "+63 920 111 2233",
            status: "Denied",
            amount: "₱2,000",
            purpose: "Bills / Utilities",
            term: "1 Month"
        },

        daniel: {
            initials: "DG",
            name: "Daniel Garcia",
            applicationId: "APP-2026-009",
            phone: "+63 918 444 6677",
            status: "Approved",
            amount: "₱3,000",
            purpose: "Education",
            term: "3 Months"
        },

        katrina: {
            initials: "KV",
            name: "Katrina Villanueva",
            applicationId: "APP-2026-010",
            phone: "+63 927 555 8899",
            status: "Approved",
            amount: "₱2,500",
            purpose: "Personal Needs",
            term: "3 Months"
        }

    };


    /* =====================================================
       CURRENT SELECTED APPLICATION
    ===================================================== */

    let selectedApplicantKey = null;


    /* =====================================================
       DATATABLE
    ===================================================== */

    let applicationsTable = null;

    const tableElement =
        document.getElementById("applicationsTable");


    if (
        tableElement &&
        typeof DataTable !== "undefined"
    ) {

        applicationsTable =
            new DataTable("#applicationsTable", {

                pageLength: 10,

                lengthMenu: [
                    5,
                    10,
                    25,
                    50
                ],

                order: [
                    [3, "desc"]
                ],

                columnDefs: [
                    {
                        targets: 8,
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {

                    search: "",

                    lengthMenu:
                        "Show _MENU_ entries",

                    info:
                        "Showing _START_ to _END_ of _TOTAL_ applications",

                    infoEmpty:
                        "No applications available",

                    zeroRecords:
                        "No matching applications found",

                    paginate: {
                        first: "«",
                        previous: "‹",
                        next: "›",
                        last: "»"
                    }

                }

            });

    }


    /* =====================================================
       CUSTOM SEARCH
    ===================================================== */

    if (
        applicantSearch &&
        applicationsTable
    ) {

        applicantSearch.addEventListener(
            "input",
            function () {

                applicationsTable
                    .search(applicantSearch.value)
                    .draw();

            }
        );

    }


    /* =====================================================
       STATUS FILTER

       Status = column index 7
    ===================================================== */

    if (
        statusFilter &&
        applicationsTable
    ) {

        statusFilter.addEventListener(
            "change",
            function () {

                const value =
                    statusFilter.value;

                if (value) {

                    applicationsTable
                        .column(7)
                        .search(
                            "^" +
                            escapeRegex(value) +
                            "$",
                            true,
                            false
                        );

                } else {

                    applicationsTable
                        .column(7)
                        .search("");

                }

                applicationsTable.draw();

            }
        );

    }


    /* =====================================================
       TERM FILTER

       Term = column index 6
    ===================================================== */

    if (
        termFilter &&
        applicationsTable
    ) {

        termFilter.addEventListener(
            "change",
            function () {

                const value =
                    termFilter.value;

                if (value) {

                    applicationsTable
                        .column(6)
                        .search(
                            "^" +
                            escapeRegex(value) +
                            "$",
                            true,
                            false
                        );

                } else {

                    applicationsTable
                        .column(6)
                        .search("");

                }

                applicationsTable.draw();

            }
        );

    }


    /* =====================================================
       RESET FILTERS
    ===================================================== */

    if (
        resetFilters &&
        applicationsTable
    ) {

        resetFilters.addEventListener(
            "click",
            function () {

                applicantSearch.value = "";
                statusFilter.value = "";
                termFilter.value = "";

                applicationsTable.search("");

                applicationsTable
                    .columns()
                    .search("");

                applicationsTable.draw();

            }
        );

    }


    /* =====================================================
       ESCAPE REGEX
    ===================================================== */

    function escapeRegex(value) {

        return value.replace(
            /[.*+?^${}()|[\]\\]/g,
            "\\$&"
        );

    }


    /* =====================================================
       VIEW APPLICATION

       Event delegation is important because DataTables
       redraws the table when sorting/filtering/paging.
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const viewButton =
                event.target.closest(
                    ".view-application-btn"
                );


            if (!viewButton) {
                return;
            }


            const applicantKey =
                viewButton.dataset.applicant;


            const application =
                applications[applicantKey];


            if (!application) {
                return;
            }


            selectedApplicantKey =
                applicantKey;


            populateDrawer(application);

            openDrawer();

        }
    );


    /* =====================================================
       POPULATE DRAWER
    ===================================================== */

    function populateDrawer(application) {

        setText(
            "drawerApplicantName",
            application.name
        );

        setText(
            "drawerApplicationId",
            application.applicationId
        );

        setText(
            "drawerAvatar",
            application.initials
        );

        setText(
            "drawerProfileName",
            application.name
        );

        setText(
            "drawerPhone",
            application.phone
        );

        setText(
            "detailFullName",
            application.name
        );

        setText(
            "detailPhone",
            application.phone
        );

        setText(
            "detailLoanAmount",
            application.amount
        );

        setText(
            "detailPurpose",
            application.purpose
        );

        setText(
            "detailTerm",
            application.term
        );


        /* =========================
           STATUS
        ========================= */

        const statusElement =
            document.getElementById(
                "drawerStatus"
            );


        if (statusElement) {

            statusElement.textContent =
                application.status;


            statusElement.classList.remove(
                "pending-status",
                "approved-status",
                "denied-status"
            );


            if (
                application.status ===
                "Approved"
            ) {

                statusElement.classList.add(
                    "approved-status"
                );

            } else if (
                application.status ===
                "Denied"
            ) {

                statusElement.classList.add(
                    "denied-status"
                );

            } else {

                statusElement.classList.add(
                    "pending-status"
                );

            }

        }


        /* =========================
           RESET TAB TO PERSONAL
        ========================= */

        activateDrawerTab(
            "personal"
        );

    }


    /* =====================================================
       TEXT HELPER
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
       OPEN DRAWER
    ===================================================== */

    function openDrawer() {

        if (
            !workspace ||
            !drawer
        ) {
            return;
        }


        workspace.classList.add(
            "drawer-open"
        );


        drawer.setAttribute(
            "aria-hidden",
            "false"
        );


        /*
           Recalculate DataTables width
           after the drawer animation.
        */

        setTimeout(
            function () {

                if (applicationsTable) {

                    applicationsTable
                        .columns
                        .adjust();

                }

            },
            260
        );

    }


    /* =====================================================
       CLOSE DRAWER
    ===================================================== */

    function closeDrawer() {

        if (
            !workspace ||
            !drawer
        ) {
            return;
        }


        workspace.classList.remove(
            "drawer-open"
        );


        drawer.setAttribute(
            "aria-hidden",
            "true"
        );


        selectedApplicantKey = null;


        setTimeout(
            function () {

                if (applicationsTable) {

                    applicationsTable
                        .columns
                        .adjust();

                }

            },
            260
        );

    }


    if (closeDrawerButton) {

        closeDrawerButton.addEventListener(
            "click",
            closeDrawer
        );

    }


    /* =====================================================
       ESC KEY CLOSES DRAWER
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                workspace &&
                workspace.classList.contains(
                    "drawer-open"
                )
            ) {

                closeDrawer();

            }

        }
    );


    /* =====================================================
       DRAWER TABS
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const tabButton =
                event.target.closest(
                    ".drawer-tab"
                );


            if (!tabButton) {
                return;
            }


            activateDrawerTab(
                tabButton.dataset.tab
            );

        }
    );


    function activateDrawerTab(tabName) {

        const tabs =
            document.querySelectorAll(
                ".drawer-tab"
            );


        const panels =
            document.querySelectorAll(
                ".drawer-panel"
            );


        tabs.forEach(
            function (tab) {

                tab.classList.toggle(
                    "active",
                    tab.dataset.tab ===
                    tabName
                );

            }
        );


        panels.forEach(
            function (panel) {

                panel.classList.toggle(
                    "active",
                    panel.dataset.panel ===
                    tabName
                );

            }
        );

    }


    /* =====================================================
       APPLICATION ACTION BUTTONS
    ===================================================== */

    const approveButton =
        document.getElementById(
            "approveApplication"
        );


    const denyButton =
        document.getElementById(
            "denyApplication"
        );


    const requestInfoButton =
        document.getElementById(
            "requestMoreInfo"
        );


    /* =====================================================
       APPROVE APPLICATION
    ===================================================== */

    if (approveButton) {

        approveButton.addEventListener(
            "click",
            function () {

                if (!selectedApplicantKey) {
                    return;
                }


                const application =
                    applications[
                        selectedApplicantKey
                    ];


                Swal.fire({

                    title:
                        "Approve Application?",

                    html:
                        "Are you sure you want to approve <b>" +
                        application.name +
                        "</b>'s loan application?",

                    icon:
                        "question",

                    showCancelButton:
                        true,

                    confirmButtonText:
                        "Yes, Approve",

                    cancelButtonText:
                        "Cancel",

                    confirmButtonColor:
                        "#15975b",

                    cancelButtonColor:
                        "#6c757d",

                    reverseButtons:
                        true

                }).then(
                    (result) => {

                        if (
                            result.isConfirmed
                        ) {

                            /*
                               BACKEND APPROVE
                               FUNCTION GOES HERE.
                            */


                            Swal.fire({

                                title:
                                    "Application Approved!",

                                text:
                                    application.name +
                                    "'s loan application has been approved successfully.",

                                icon:
                                    "success",

                                confirmButtonText:
                                    "OK",

                                confirmButtonColor:
                                    "#15975b"

                            });

                        }

                    }
                );

            }
        );

    }


    /* =====================================================
       DENY APPLICATION
    ===================================================== */

    if (denyButton) {

        denyButton.addEventListener(
            "click",
            function () {

                if (!selectedApplicantKey) {
                    return;
                }


                const application =
                    applications[
                        selectedApplicantKey
                    ];


                Swal.fire({

                    title:
                        "Deny Application?",

                    html:
                        "Are you sure you want to deny <b>" +
                        application.name +
                        "</b>'s loan application?",

                    icon:
                        "warning",

                    showCancelButton:
                        true,

                    confirmButtonText:
                        "Yes, Deny",

                    cancelButtonText:
                        "Cancel",

                    confirmButtonColor:
                        "#ef3d49",

                    cancelButtonColor:
                        "#6c757d",

                    reverseButtons:
                        true

                }).then(
                    (result) => {

                        if (
                            result.isConfirmed
                        ) {

                            /*
                               BACKEND DENY
                               FUNCTION GOES HERE.
                            */


                            Swal.fire({

                                title:
                                    "Application Denied",

                                text:
                                    application.name +
                                    "'s loan application has been denied.",

                                icon:
                                    "success",

                                confirmButtonText:
                                    "OK",

                                confirmButtonColor:
                                    "#ef3d49"

                            });

                        }

                    }
                );

            }
        );

    }


    /* =====================================================
       REQUEST MORE INFORMATION

       NO ALERT HERE.

       This will later open its own form/modal
       because the admin needs to specify what
       information/document is missing.
    ===================================================== */

    if (requestInfoButton) {

        requestInfoButton.addEventListener(
            "click",
            function () {

                if (!selectedApplicantKey) {
                    return;
                }


                const application =
                    applications[
                        selectedApplicantKey
                    ];


                console.log(
                    "Open Request More Information form for:",
                    application.name
                );


                /*
                   NEXT:
                   Open Request Information modal here.
                */

            }
        );

    }


    /* =====================================================
       DOCUMENT VIEW BUTTONS

       Temporary only.
       Later connect this to actual uploaded files.
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const documentButton =
                event.target.closest(
                    ".document-view-btn"
                );


            if (!documentButton) {
                return;
            }


            console.log(
                "Open uploaded document preview."
            );

        }
    );

});