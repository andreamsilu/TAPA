<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Font Awesome -->
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .sidebar {
        height: 100vh;
        background-color: #343a40;
        padding: 15px;
    }

    .sidebar h2 {
        color: #fff;
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        margin: 10px 0;
    }

    .sidebar ul li a {
        color: #ddd;
        text-decoration: none;
        font-size: 16px;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a:hover {
        color: #fff;
    }

    .sidebar ul li a i {
        margin-right: 10px;
        /* Space between icon and text */
    }

    .content {
        padding: 20px;
        flex-grow: 1;
    }

    .container {
        display: flex;
    }
    </style>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <h2>Navigation</h2>
            <ul>
                <li><a href="index.php"><i class="fas fa-users"></i> Members</a></li>
                <li><a href="register.php"><i class="fas fa-user-plus"></i> Register Member</a></li>
                <li><a href="members.php"><i class="fas fa-eye"></i> View Members</a></li>
                <!-- Add more links as needed -->
            </ul>
        </nav>
        <div class="content">
            <?php include($page); ?>
            <!-- Include the content of the specific page -->
        </div>
    </div>
</body>

</html>