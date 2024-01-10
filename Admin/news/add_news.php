
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include "../../forms/connection.php";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];

    // File upload directories
    $image_target_dir = "uploads/images/";
    $video_target_dir = "uploads/videos/";

    // File upload paths
    $image_file = $image_target_dir . basename($_FILES["image_url"]["name"]);
    $video_file = $video_target_dir . basename($_FILES["video_url"]["name"]);

    // Upload image and video files
    if (
        move_uploaded_file($_FILES["image_url"]["tmp_name"], $image_file) &&
        move_uploaded_file($_FILES["video_url"]["tmp_name"], $video_file)
    ) {
        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO news (title, description, image_url, date, video_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $image_file, $date, $video_file);

        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect to add news form with success message
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading files.";
    }

    $conn->close();
}
?>



<?php include "navigation.php"; ?>

<div class="container mt-5">
    <h2 class="text-center">Add News</h2>
    <form action="add_news.php" method="post" enctype="multipart/form-data" style="margin:20px">
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
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>
</div>

<?php include "footer.php"; ?>