<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMpT72nxG3Z/8a1QRdBOWZmN8W3H7kXlF4pD1f" crossorigin="anonymous">
<style>
.card {
    transition: transform 0.3s;
}

.card:hover {
    transform: scale(1.05);
}

.card-icon {
    font-size: 40px;
    color: #007bff;
    /* Bootstrap primary color */
    margin-bottom: 20px;
}

.card-body {
    text-align: center;
    /* Center the text in the card body */
}
</style>

<div class="container mt-5">
    <h2>Dashboard</h2>

    <div class="row">
        <!-- Total Members Card -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users card-icon"></i>
                    Total Members
                </div>
                <div class="card-body">
                    <?php
                    require 'db.php';
                    $result = $conn->query("SELECT COUNT(*) as total_members FROM member");
                    $data = $result->fetch_assoc();
                    echo "<h3>{$data['total_members']}</h3>";
                    ?>
                </div>
            </div>
        </div>

        <!-- Active Members Card -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-check-circle card-icon"></i>
                    Active Members (Paid)
                </div>
                <div class="card-body">
                    <?php
                    // Assuming there's a 'payment_date' field to check for payment status
                    $currentYear = date('Y');
                    $result = $conn->query("SELECT COUNT(*) as active_members FROM fees WHERE status = 1 AND YEAR(year_id) = $currentYear");
                    $data = $result->fetch_assoc();
                    echo "<h3>{$data['active_members']}</h3>";
                    ?>
                </div>
            </div>
        </div>

        <!-- Members by Type Cards -->
        <?php
        $result = $conn->query("SELECT member_type_id, COUNT(*) as count FROM member GROUP BY member_type_id");
        while ($row = $result->fetch_assoc()) {
            $memberTypeId = $row['member_type_id'];
            $count = $row['count'];
            ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-id-card card-icon"></i>
                    Member Type ID <?php echo $memberTypeId; ?>
                </div>
                <div class="card-body">
                    <h3><?php echo $count; ?></h3>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <!-- Recent Members Card -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-clock card-icon"></i>
                    Recent Members
                </div>
                <div class="card-body">
                    <?php
                    $result = $conn->query("SELECT firstname, lastname, created_at FROM member ORDER BY created_at DESC LIMIT 5");
                    echo "<ul class='list-group'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item'>{$row['firstname']} {$row['lastname']} - {$row['created_at']}</li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>