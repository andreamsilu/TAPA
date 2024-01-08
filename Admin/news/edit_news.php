<?php include "navigation.php"; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include "../../forms/connection.php";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the UPDATE statement
    $stmt = $conn->prepare("UPDATE news SET title=?, description=?, image_url=?, date=?, video_url=? WHERE id=?");
    $stmt->bind_param("sssssi", $title, $description, $image_url, $date, $video_url, $id);

    // Set parameters
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];

    // Handle file uploads for image and video URLs
    $image_url = uploadFile('image_url', 'uploads/images/');
    $video_url = uploadFile('video_url', 'uploads/videos/');

    if ($stmt->execute()) {
        header("Location: read_news.php?id=$id&success=1"); // Redirect to edit news form with success message
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Function to handle file uploads
function uploadFile($fileKey, $targetDirectory)
{
    $target_file = $targetDirectory . basename($_FILES[$fileKey]["name"]);
    $uploadOk = 1;

    // Check if file already exists - You may want to modify this check

    // Check file size, type, and handle upload
    if ($uploadOk) {
        if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
            return $target_file; // Return the uploaded file path
        } else {
            echo "Sorry, there was an error uploading your file.";
            return ''; // Return empty string indicating failure
        }
    } else {
        return ''; // Return empty string indicating failure
    }
}
?>

<div class="container mt-5">
    <h2>Edit News</h2>
    <?php
    include "../../forms/connection.php";

    // Check if an ID is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM news WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $article = $result->fetch_assoc();
    ?>
            <form action="edit_news.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $article['description']; ?></textarea>
                </div>
                <div class="form-group">
    <label for="image_url">Image:</label>
    <div class="input-group">
        <input type="file" class="form-control" id="image_url" name="image_url">
        <label class="input-group-text" for="image_url">Choose file</label>
    </div>
    <small>Current Image: <?php echo $article['image_url']; ?></small>
</div>

<div class="form-group">
    <label for="date">Date:</label>
    <input type="date" class="form-control" id="date" name="date" value="<?php echo $article['date']; ?>" required>
</div>

<div class="form-group">
    <label for="video_url">Video:</label>
    <div class="input-group">
        <input type="file" class="form-control" id="video_url" name="video_url">
        <label class="input-group-text" for="video_url">Choose file</label>
    </div>
    <small>Current Video: <?php echo $article['video_url']; ?></small>
</div>

                <button type="submit" class="btn btn-primary">Update News</button>
            </form>
    <?php
        } else {
            echo "News article not found.";
        }
    } else {
        echo "News ID not provided.";
    }
    ?>
</div>

<?
include "footer.php";
?>