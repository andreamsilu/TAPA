<?php
require 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM membership_year WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];

    // Update the membership year
    $stmt = $conn->prepare("UPDATE membership_year SET year = ? WHERE id = ?");
    $stmt->bind_param("si", $year, $id);
    if ($stmt->execute()) {
        header("Location: list_membership_years.php"); // Redirect to list page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'header.php' ?>


<div class="container mt-5">
    <h2>Edit Membership Year</h2>
    <form method="POST" action="edit_membership_year.php?id=<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" name="year" class="form-control" value="<?php echo $row['year']; ?>" required>
            <small class="form-text text-muted">Format: YYYY-YYYY (e.g., 2024-2025)</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Year</button>
        <a href="list_membership_years.php" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php include 'footer.php' ?>