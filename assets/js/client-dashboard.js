document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       PENDING DUES DATATABLE
    ====================================================== */

    const pendingDuesTable =
        document.getElementById("pendingDuesTable");

    if (pendingDuesTable) {

        new DataTable("#pendingDuesTable", {

            pageLength: 5,

            lengthMenu: [5, 10, 25, 50],

            order: [[1, "asc"]],

            columnDefs: [
                {
                    targets: 3,
                    orderable: true,
                    searchable: true
                }
            ],

            language: {

                search: "",

                searchPlaceholder:
                    "Search dues...",

                lengthMenu:
                    "Show _MENU_ entries",

                info:
                    "Showing _START_ to _END_ of _TOTAL_ dues",

                infoEmpty:
                    "No dues available",

                zeroRecords:
                    "No matching dues found"

            }

        });

    }


    /* =====================================================
       PAYMENT HISTORY DATATABLE
    ====================================================== */

    const paymentHistoryTable =
        document.getElementById(
            "paymentHistoryTable"
        );

    if (paymentHistoryTable) {

        new DataTable("#paymentHistoryTable", {

            pageLength: 5,

            lengthMenu: [5, 10, 25, 50],

            order: [[0, "desc"]],

            columnDefs: [
                {
                    targets: 3,
                    orderable: true,
                    searchable: true
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
                    "No matching payments found"

            }

        });

    }


    /* =====================================================
       MOBILE SIDEBAR
    ====================================================== */

    const mobileMenuBtn =
        document.getElementById("mobileMenuBtn");

    const sidebar =
        document.querySelector(".sidebar");

    const sidebarOverlay =
        document.getElementById("sidebarOverlay");


    if (
        mobileMenuBtn &&
        sidebar &&
        sidebarOverlay
    ) {

        mobileMenuBtn.addEventListener(
            "click",
            function () {

                sidebar.classList.toggle("open");

                sidebarOverlay.classList.toggle(
                    "show"
                );

            }
        );


        sidebarOverlay.addEventListener(
            "click",
            function () {

                sidebar.classList.remove("open");

                sidebarOverlay.classList.remove(
                    "show"
                );

            }
        );


        const sidebarLinks =
            document.querySelectorAll(
                ".sidebar .menu-item"
            );


        sidebarLinks.forEach(function (link) {

            link.addEventListener(
                "click",
                function () {

                    if (window.innerWidth <= 1150) {

                        sidebar.classList.remove(
                            "open"
                        );

                        sidebarOverlay.classList.remove(
                            "show"
                        );

                    }

                }
            );

        });


        window.addEventListener(
            "resize",
            function () {

                if (window.innerWidth > 1150) {

                    sidebar.classList.remove(
                        "open"
                    );

                    sidebarOverlay.classList.remove(
                        "show"
                    );

                }

            }
        );

    }

});