<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Uncommented session_start()

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include "../../forms/connection.php";

    // Get form data with default values
    $category = isset($_POST["category"]) ? $_POST["category"] : "";
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $description = isset($_POST["description"]) ? $_POST["description"] : "";
    $date = isset($_POST["date"]) ? $_POST["date"] : "";

    // File upload directories
    $image_target_dir = "uploads/images/";
    $video_target_dir = "uploads/videos/";

    // File upload paths with default values
    $image_file = "";
    $video_file = "";

    // Upload image file if provided
    if (isset($_FILES["image_url"]["name"]) && !empty($_FILES["image_url"]["name"])) {
        $image_file = $image_target_dir . basename($_FILES["image_url"]["name"]);
        move_uploaded_file($_FILES["image_url"]["tmp_name"], $image_file);
    }

    // Upload video file if provided
    if (isset($_FILES["video_url"]["name"]) && !empty($_FILES["video_url"]["name"])) {
        $video_file = $video_target_dir . basename($_FILES["video_url"]["name"]);
        move_uploaded_file($_FILES["video_url"]["tmp_name"], $video_file);
    }

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO news (category,title, description, image_url, date, video_url) VALUES (?, ?, ?, ?, ?, ?)");

    // Check if the statement is prepared successfully
    if ($stmt) {
        $stmt->bind_param("ssssss", $category, $title, $description, $image_file, $date, $video_file);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to index.php with success message
            header("Location: index.php");
            exit(); // Stop further execution
        } else {
            // Display error if execution fails
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Display error if preparation fails
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<?php include "navigation.php"; ?>

<div class="container mt-5 mb-5">
    <h2 class="text-center"><b>ADD NEWS</b></h2>
    <div class="card">
        <div class="card-body">
            <form action="add_news.php" method="post" enctype="multipart/form-data">
                <!-- Form fields -->
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="all_members">All members</option>
                        <option value="membership_only">Only with membership</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image_url">Image:</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="video_url">Video:</label>
                    <input type="file" class="form-control" id="video_url" name="video_url">
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Add News</button>
            </form>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>