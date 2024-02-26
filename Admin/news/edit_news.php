<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Uncommented session_start()

include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
// Declare $stmt outside the if block
$stmt = null;

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
            return ''; // Return an empty string indicating failure
        }
    } else {
        return ''; // Return an empty string indicating failure
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
   include('../../forms/connection.php');

    // Get form data with default values
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
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
        $image_file = uploadFile("image_url", $image_target_dir);
    }

    // Upload video file if provided
    if (isset($_FILES["video_url"]["name"]) && !empty($_FILES["video_url"]["name"])) {
        $video_file = uploadFile("video_url", $video_target_dir);
    }

    // Prepare and bind the UPDATE statement
    $stmt = $conn->prepare("UPDATE news SET category=?, title=?, description=?, image_url=?, date=?, video_url=? WHERE id=?");

    // Check if the statement is prepared successfully
    if ($stmt) {
        $stmt->bind_param("ssssssi",$category, $title, $description, $image_file, $date, $video_file, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to read_news.php with success message
            header("Location: show_news_admin.php?id=$id&success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

include "navigation.php";
?>

<div class="container mt-5">
    <h2>Edit News</h2>
    <?php
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
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="all_members">All members</option>
                        <option value="membership_only">Only with membership</option>
                    </select>
                </div>
                
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

<div class="row">
    <div class="col">
        <button type="submit" class="btn btn-primary">Update News</button>
    </div>
    <div class="col">
        <a href="show_news_admin.php?id=<?php echo $id; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</div>

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

<?php
include "footer.php";
?>
