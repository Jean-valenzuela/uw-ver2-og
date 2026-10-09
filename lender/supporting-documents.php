<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Supporting Documents | Utang Wise</title>

    <link rel="stylesheet" href="../css/loaners-priv.css">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    >
</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ₱
            </div>

            <div>
                <h2>UTANG WISE</h2>
                <span>LENDING MADE SIMPLE</span>
            </div>

        </div>


        <nav class="sidebar-menu">

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">home</span>
                Dashboard
            </a>

            <a href="loaners-priv.php" class="menu-item active">
                <span class="material-symbols-outlined">groups</span>
                Loaners
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">description</span>
                Applications
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">schedule</span>
                Extension Requests
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">
                    account_balance_wallet
                </span>
                Debts / Loans
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">bar_chart</span>
                Payments
            </a>

            <a href="#" class="menu-item">
                <span class="material-symbols-outlined">history</span>
                Reports
            </a>

        </nav>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">

                <span class="material-symbols-outlined">
                    search
                </span>

                <input
                    type="text"
                    placeholder="Search client name, phone number, or ID..."
                >

            </div>


            <div class="top-user">

                <span class="material-symbols-outlined">
                    notifications
                </span>

                <div class="admin-avatar">

                    <span class="material-symbols-outlined">
                        person
                    </span>

                </div>

                <div class="admin-text">
                    <strong>Admin</strong>
                    <span>Loan Officer</span>
                </div>

            </div>

        </header>


        <div class="page-content">


            <!-- HEADING -->
            <div class="page-heading">

                <div>

                    <div class="breadcrumb">
                        Loaners
                        <span>›</span>
                        Juan Dela Cruz
                    </div>

                    <h1>
                        Client Profile
                    </h1>

                    <p>
                        View and manage client information,
                        loans, and documents.
                    </p>

                </div>

            </div>


            <!-- TABS -->
            <div class="tabs">

                <a href="loaners-priv.php" class="tab">

                    <span class="material-symbols-outlined">
                        person
                    </span>

                    Basic Information

                </a>


                <a
                    href="supporting-documents.php"
                    class="tab active"
                >

                    <span class="material-symbols-outlined">
                        description
                    </span>

                    Supporting Documents

                </a>


                <a href="loan-history.php" class="tab">

                    <span class="material-symbols-outlined">
                        history
                    </span>

                    Loan History

                </a>


                <a href="legal-agreements.php" class="tab">

                    <span class="material-symbols-outlined">
                        contract
                    </span>

                    Legal Agreements

                </a>


                <a href="reference-person-admin.php" class="tab">

                    <span class="material-symbols-outlined">
                        groups
                    </span>

                    Reference Person

                </a>

            </div>


            <!-- DOCUMENTS CARD -->
            <section class="documents-card">

                <div class="documents-heading">

                    <div>

                        <span class="material-symbols-outlined">
                            description
                        </span>

                        <h2>
                            Supporting Documents
                        </h2>

                    </div>


                    <button class="upload-document-button">

                        <span class="material-symbols-outlined">
                            upload
                        </span>

                        Upload Document

                    </button>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Document Type</th>
                                <th>File Name</th>
                                <th>Date Uploaded</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>Valid ID (1)</td>
                                <td>philhealth-id.jpg</td>
                                <td>Jan 15, 2025</td>

                                <td>
                                    <span class="status verified-status">
                                        Verified
                                    </span>
                                </td>

                                <td>
                                    <a href="#">View</a>
                                </td>
                            </tr>


                            <tr>
                                <td>2</td>
                                <td>Valid ID (2)</td>
                                <td>tin-id.jpg</td>
                                <td>Jan 15, 2025</td>

                                <td>
                                    <span class="status verified-status">
                                        Verified
                                    </span>
                                </td>

                                <td>
                                    <a href="#">View</a>
                                </td>
                            </tr>


                            <tr>
                                <td>3</td>
                                <td>Valid ID (3)</td>
                                <td>passport.jpg</td>
                                <td>Jan 16, 2025</td>

                                <td>
                                    <span class="status verified-status">
                                        Verified
                                    </span>
                                </td>

                                <td>
                                    <a href="#">View</a>
                                </td>
                            </tr>


                            <tr>
                                <td>4</td>
                                <td>Certificate of Employment</td>
                                <td>coe.jpg</td>
                                <td>Jan 16, 2025</td>

                                <td>
                                    <span class="status verified-status">
                                        Verified
                                    </span>
                                </td>

                                <td>
                                    <a href="#">View</a>
                                </td>
                            </tr>


                            <tr>
                                <td>5</td>
                                <td>PSA Birth Certificate</td>
                                <td>birth-cert.jpg</td>
                                <td>Jan 16, 2025</td>

                                <td>
                                    <span class="status verified-status">
                                        Verified
                                    </span>
                                </td>

                                <td>
                                    <a href="#">View</a>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>


                <div class="documents-note">

                    <span class="material-symbols-outlined">
                        info
                    </span>

                    These are the initial supporting documents
                    submitted by the client.

                </div>

            </section>

        </div>

    </main>

</div>

</body>
</html>