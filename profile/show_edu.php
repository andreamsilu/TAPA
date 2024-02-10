<?php
session_start();
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

include "navigation.php";

// Retrieve education details from the 'education' table
$sql = "SELECT * FROM education";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-journal-text"></i> Education Details</h2>
            <a href="add_edu.php" class="btn btn-primary"><i class="bi bi-plus"></i> Add</a>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="bi bi-award-fill"></i> Award</th>
                                <th scope="col"><i class="bi bi-building"></i> Institution</th>
                                <th scope="col"><i class="bi bi-calendar-check"></i> Year of Graduation</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row['award']; ?></td>
                                    <td><?php echo $row['institution']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td>
                                        <a href="edit_edu.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                        <a class="btn btn-danger delete-btn" href="delete-edu.php?id=<?php echo $row['id']; ?>"><i class="bi bi-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <!-- <p>No education details found.</p> -->
                <a class="btn btn-primary" href="add-edu.php"><i class="bi bi-plus"></i> Add</a>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
