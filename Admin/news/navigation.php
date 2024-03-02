<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons bundled with Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet"> -->
    <style>
        /* Adjust sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding-top: 60px; /* Adjust according to your navbar height */
            background-color: #333;
            color: #fff;
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #0F718A;
            color: #fff;
        }

        .sidebar a:active {
            color: #0F718A;
        }

        .dropdown-menu {
            background-color: #333;
            color: #fff;
        }

        .nav-link {
            color: white;
        }

        i {
            font-size: 28px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-success bg-dark">
    <a class="navbar-brand" href="index.php">TAPA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">updateProgressBar</a> -->
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">membership fees</a> -->
            </li>
            <!-- Add other navigation links here -->
        </ul>

        <!-- Profile Avatar with Dropdown -->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar navigation -->
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_news.php">
                            <i class="bi bi-newspaper"></i> Add News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="show_news_admin.php">
                            <i class="bi bi-journal-text"></i> Fetch News
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-people"></i> Membership
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="member_list.php">
                                <i class="bi bi-people"></i> Member List
                            </a>
                            <a class="dropdown-item" href="membership_fees.php">
                                <i class="bi bi-cash"></i> Membership Fees
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-briefcase"></i> Jobs & Updates
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="member_list.php">
                                <i class="bi bi-people"></i> Jobs
                            </a>
                            <a class="dropdown-item" href="membership_fees.php">
                                <i class="bi bi-megaphone"></i> Announcements
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="show_users.php">
                            <i class="bi bi-person"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Main content area -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10">
          