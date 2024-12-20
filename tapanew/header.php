<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Registration</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Boxicons for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Geist:wght@400;500;700&display=swap');

    body {
        font-family: 'Geist', sans-serif;
    }

    /* Sidebar styles using Bootstrap */
    .sidebar {
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        background-color: #343a40;
        /* Dark background */
        padding-top: 3rem;
    }

    .sidebar .nav-link {
        color: white;
        padding: 15px 20px;
        font-size: 1rem;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 1.25rem;
    }

    /* Remove underline */
    .sidebar .nav-link {
        text-decoration: none;
    }

    /* Active link styling */
    .sidebar .nav-link.active {
        background-color: #007bff;
        /* Primary color for active */
        color: white;
    }

    /* Hover state */
    .sidebar .nav-link:hover {
        background-color: #007bff;
        /* Primary color on hover */
        color: white;
        /* White text on hover */
    }

    /* Content padding */
    .content {
        margin-left: 250px;
        padding: 2rem;
        margin-top: 3rem;
    }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="nav flex-column">
            <a href="#" class="nav-link active" id="dashboard-link">
                <i class="bx bx-layer"></i>
                <span>TAPA MEMBERSHIP</span>
            </a>
            <a href="index.php" class="nav-link">
                <i class="bx bx-grid-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="member_types.php" class="nav-link">
                <i class="bx bx-user"></i>
                <span>Membership Types & Fees</span>
            </a>
            <a href="member.php" class="nav-link">
                <i class="bx bx-message-square-detail"></i>
                <span>Membership Management</span>
            </a>
            <a href="list_fees.php" class="nav-link">
                <i class="bx bx-bookmark"></i>
                <span>Fees Management</span>
            </a>
            <a href="list_membership_years.php" class="nav-link">
                <i class="bx bx-folder"></i>
                <span>Membership Years</span>
            </a>
            <a href="#" class="nav-link">
                <i class="bx bx-bar-chart-alt-2"></i>
                <span>Stats</span>
            </a>
            <a href="#" class="nav-link">
                <i class="bx bx-log-out"></i>
                <span>Sign Out</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content">