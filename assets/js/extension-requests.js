document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const workspace =
        document.getElementById("extensionWorkspace");

    const drawer =
        document.getElementById("requestDrawer");

    const closeDrawerButton =
        document.getElementById("closeDrawer");

    const searchInput =
        document.getElementById("extensionSearch");

    const statusFilter =
        document.getElementById("statusFilter");

    const termFilter =
        document.getElementById("termFilter");

    const resetFilters =
        document.getElementById("resetFilters");


    /* =====================================================
       TEMPORARY REQUEST DATA
    ===================================================== */

    const requests = {

        maria: {
            initials: "MS",
            name: "Maria Santos",
            requestId: "EXT-2026-001",
            status: "Pending",
            currentTerm: "3 Months",
            requestedTerm: "6 Months",
            balance: "₱2,450",
            dueDate: "Oct 15, 2026",
            requestDate: "Sep 28, 2026 10:24 AM",
            reason:
                "I'm currently experiencing financial difficulties due to unexpected medical expenses.",
            document: "Medical Receipt.pdf"
        },

        juan: {
            initials: "JD",
            name: "Juan Dela Cruz",
            requestId: "EXT-2026-002",
            status: "Approved",
            currentTerm: "3 Months",
            requestedTerm: "6 Months",
            balance: "₱1,800",
            dueDate: "Oct 20, 2026",
            requestDate: "Sep 27, 2026 9:10 AM",
            reason:
                "Unexpected household expenses affected my scheduled payment.",
            document: "Supporting Document.pdf"
        },

        ana: {
            initials: "AC",
            name: "Ana Cruz",
            requestId: "EXT-2026-003",
            status: "Pending",
            currentTerm: "6 Months",
            requestedTerm: "9 Months",
            balance: "₱2,100",
            dueDate: "Oct 25, 2026",
            requestDate: "Sep 26, 2026 2:30 PM",
            reason:
                "I am requesting additional time due to temporary financial difficulties.",
            document: "Income Document.pdf"
        },

        pedro: {
            initials: "PR",
            name: "Pedro Reyes",
            requestId: "EXT-2026-004",
            status: "Denied",
            currentTerm: "1 Month",
            requestedTerm: "3 Months",
            balance: "₱1,500",
            dueDate: "Oct 10, 2026",
            requestDate: "Sep 25, 2026 11:15 AM",
            reason:
                "I need additional time because of unexpected personal expenses.",
            document: "Supporting Document.pdf"
        },

        mark: {
            initials: "MR",
            name: "Mark Rivera",
            requestId: "EXT-2026-005",
            status: "Approved",
            currentTerm: "6 Months",
            requestedTerm: "9 Months",
            balance: "₱2,700",
            dueDate: "Oct 28, 2026",
            requestDate: "Sep 24, 2026 4:05 PM",
            reason:
                "Temporary reduction in income affected my repayment schedule.",
            document: "Income Statement.pdf"
        },

        liza: {
            initials: "LM",
            name: "Liza Mendoza",
            requestId: "EXT-2026-006",
            status: "Pending",
            currentTerm: "3 Months",
            requestedTerm: "6 Months",
            balance: "₱2,250",
            dueDate: "Oct 30, 2026",
            requestDate: "Sep 23, 2026 1:45 PM",
            reason:
                "I am requesting an extension because of emergency family expenses.",
            document: "Supporting Document.pdf"
        }

    };


    let selectedRequestKey = null;


    /* =====================================================
       DATATABLE
    ===================================================== */

    let extensionTable = null;


    if (
        document.getElementById("extensionTable") &&
        typeof DataTable !== "undefined"
    ) {

        extensionTable =
            new DataTable("#extensionTable", {

                pageLength: 10,

                lengthMenu: [
                    5,
                    10,
                    25,
                    50
                ],

                order: [
                    [5, "desc"]
                ],

                columnDefs: [
                    {
                        targets: 7,
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {

                    search: "",

                    lengthMenu:
                        "Show _MENU_ entries",

                    info:
                        "Showing _START_ to _END_ of _TOTAL_ requests",

                    infoEmpty:
                        "No extension requests available",

                    zeroRecords:
                        "No matching extension requests found",

                    paginate: {
                        previous: "‹",
                        next: "›"
                    }

                }

            });

    }


    /* =====================================================
       SEARCH
    ===================================================== */

    if (
        searchInput &&
        extensionTable
    ) {

        searchInput.addEventListener(
            "input",
            function () {

                extensionTable
                    .search(searchInput.value)
                    .draw();

            }
        );

    }


    /* =====================================================
       STATUS FILTER
       COLUMN 6
    ===================================================== */

    if (
        statusFilter &&
        extensionTable
    ) {

        statusFilter.addEventListener(
            "change",
            function () {

                const value =
                    statusFilter.value;


                extensionTable
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
       REQUESTED TERM FILTER
       COLUMN 4
    ===================================================== */

    if (
        termFilter &&
        extensionTable
    ) {

        termFilter.addEventListener(
            "change",
            function () {

                const value =
                    termFilter.value;


                extensionTable
                    .column(4)
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
       RESET
    ===================================================== */

    if (
        resetFilters &&
        extensionTable
    ) {

        resetFilters.addEventListener(
            "click",
            function () {

                searchInput.value = "";
                statusFilter.value = "";
                termFilter.value = "";

                extensionTable.search("");

                extensionTable
                    .columns()
                    .search("");

                extensionTable.draw();

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
       VIEW REQUEST
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const button =
                event.target.closest(
                    ".view-request-btn"
                );


            if (!button) {
                return;
            }


            const key =
                button.dataset.request;


            const request =
                requests[key];


            if (!request) {
                return;
            }


            selectedRequestKey = key;


            populateDrawer(request);

            openDrawer();

        }
    );


    /* =====================================================
       POPULATE DRAWER
    ===================================================== */

    function populateDrawer(request) {

        setText(
            "drawerAvatar",
            request.initials
        );

        setText(
            "drawerName",
            request.name
        );

        setText(
            "drawerRequestId",
            request.requestId
        );

        setText(
            "drawerCurrentTerm",
            request.currentTerm
        );

        setText(
            "drawerRequestedTerm",
            request.requestedTerm
        );

        setText(
            "drawerBalance",
            request.balance
        );

        setText(
            "drawerDueDate",
            request.dueDate
        );

        setText(
            "drawerReason",
            request.reason
        );

        setText(
            "drawerRequestDate",
            request.requestDate
        );

        setText(
            "drawerDocument",
            request.document
        );


        /* STATUS */

        const status =
            document.getElementById(
                "drawerStatus"
            );


        if (status) {

            status.textContent =
                request.status;


            status.classList.remove(
                "pending",
                "approved",
                "denied"
            );


            status.classList.add(
                request.status.toLowerCase()
            );

        }


        /*
            Disable Approve/Deny if request
            was already processed.
        */

        updateActionButtons(
            request.status
        );

    }


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


        setTimeout(
            function () {

                if (extensionTable) {

                    extensionTable
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


        selectedRequestKey = null;


        setTimeout(
            function () {

                if (extensionTable) {

                    extensionTable
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
       ESC CLOSE
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
       ACTION BUTTONS
    ===================================================== */

    const approveButton =
        document.getElementById(
            "approveRequest"
        );


    const denyButton =
        document.getElementById(
            "denyRequest"
        );


    function updateActionButtons(status) {

        if (
            !approveButton ||
            !denyButton
        ) {
            return;
        }


        const processed =
            status !== "Pending";


        approveButton.disabled =
            processed;

        denyButton.disabled =
            processed;


        approveButton.style.opacity =
            processed ? ".45" : "1";

        denyButton.style.opacity =
            processed ? ".45" : "1";


        approveButton.style.cursor =
            processed
                ? "not-allowed"
                : "pointer";

        denyButton.style.cursor =
            processed
                ? "not-allowed"
                : "pointer";

    }


    /* =====================================================
       APPROVE
    ===================================================== */

    if (approveButton) {

        approveButton.addEventListener(
            "click",
            function () {

                if (!selectedRequestKey) {
                    return;
                }


                const request =
                    requests[
                        selectedRequestKey
                    ];


                if (
                    request.status !==
                    "Pending"
                ) {
                    return;
                }


                Swal.fire({

                    title:
                        "Approve Extension Request?",

                    html:
                        "Approve <b>" +
                        request.name +
                        "</b>'s extension from <b>" +
                        request.currentTerm +
                        "</b> to <b>" +
                        request.requestedTerm +
                        "</b>?",

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
                    function (result) {

                        if (
                            result.isConfirmed
                        ) {

                            /*
                                BACKEND UPDATE
                                WILL GO HERE.
                            */


                            Swal.fire({

                                title:
                                    "Extension Approved!",

                                text:
                                    request.name +
                                    "'s extension request has been approved.",

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
       DENY
    ===================================================== */

    if (denyButton) {

        denyButton.addEventListener(
            "click",
            function () {

                if (!selectedRequestKey) {
                    return;
                }


                const request =
                    requests[
                        selectedRequestKey
                    ];


                if (
                    request.status !==
                    "Pending"
                ) {
                    return;
                }


                Swal.fire({

                    title:
                        "Deny Extension Request?",

                    html:
                        "Are you sure you want to deny <b>" +
                        request.name +
                        "</b>'s extension request?",

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
                    function (result) {

                        if (
                            result.isConfirmed
                        ) {

                            /*
                                BACKEND UPDATE
                                WILL GO HERE.
                            */


                            Swal.fire({

                                title:
                                    "Extension Denied",

                                text:
                                    request.name +
                                    "'s extension request has been denied.",

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
       DOCUMENT VIEW
    ===================================================== */

    document.addEventListener(
        "click",
        function (event) {

            const button =
                event.target.closest(
                    ".document-view-btn"
                );


            if (!button) {
                return;
            }


            /*
                Later:
                window.open(actualDocumentURL, "_blank");
            */

            console.log(
                "Open supporting document."
            );

        }
    );

});