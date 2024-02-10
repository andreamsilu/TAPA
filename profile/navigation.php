<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Jss+8gN5eWPS2+xe7i7e6pZYO/dUZ37OqYz3NjcmmJ1W4Z" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Latest Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-TUoGPr7tIJKL+XAKTmwYGhM5lmTr/vpaCoa+C/7QOpj0nHLp1qO3gOeDeJZ5y11Y4W/ijE8gkPdCEwRofV5JwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Adjust sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding-top: 60px;
            /* Adjust according to your navbar height */
            background-color: #333;
            color: #fff;
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: #fff;
            text-decoration: none;

        }

        i {
            /* font-size: 28px; */
            color: #fff;
        }

        .sidebar i,a:hover {
            background-color: #0F718A;
            color: #fff;
        }

        .sidebar a:active {
            background-color: green;
            color: #0F718A;
        }

        .dropdown-menu {
            background-color: #222;
            color: #fff;
        }

        .nav-link {
            color: white;
        }

        i {
            color: #0F718A;
            padding: 3px;
            font-size: 24px;
        }

        i:hover {
            color: white;
            padding: 3px;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="index.php">TAPA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">updateProgressBar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manage</a>
                </li>
                <!-- Other Links -->
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
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person"></i> Personal info
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add_personal_info.php">
                                    <i class="bi bi-person-plus"></i> Add
                                </a>
                                <a class="dropdown-item" href="show_personal_info.php">
                                    <i class="bi bi-person-lines-fill"></i> Manage
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-telephone"></i> Contact info
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add-cont.php">
                                    <i class="bi bi-telephone-plus"></i> Contact info
                                </a>
                                <a class="dropdown-item" href="show-cont.php">
                                    <i class="bi bi-telephone-fill"></i> Manage
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-book"></i> Education info
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add_edu.php">
                                    <i class="bi bi-plus"></i> Add Education
                                </a>
                                <a class="dropdown-item" href="show_edu.php">
                                    <i class="bi bi-book-fill"></i> Manage Education
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-briefcase"></i> Work experience
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add-exp.php">
                                    <i class="bi bi-plus"></i> Add
                                </a>
                                <a class="dropdown-item" href="show-exp.php">
                                    <i class="bi bi-briefcase-fill"></i> Manage
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-file-text"></i> My CV
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add-cv.php">
                                    <i class="bi bi-file-earmark-plus"></i> Add
                                </a>
                                <a class="dropdown-item" href="show-cv.php">
                                    <i class="bi bi-file-earmark-text-fill"></i> Manage
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-file-earmark"></i> Certification
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="add-cert.php">
                                    <i class="bi bi-file-earmark-plus"></i> Add
                                </a>
                                <a class="dropdown-item" href="show-cert.php">
                                    <i class="bi bi-file-earmark-fill"></i> Manage
                                </a>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="change-password.php">
                                <i class="bi bi-shield-lock"></i> Change password
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

        </div>
        <!-- Main content area -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10">