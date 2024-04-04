<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); 

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
// Database connection
include "../../forms/connection.php";

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Get the news ID from the URL
    $news_id = $_GET['id'];

    // Prepare a SELECT query to fetch specific news article by its ID
    $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the news article details
        $news = $result->fetch_assoc();

        // Display the news article details
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title><?php echo $news['title']; ?></title>
            <!-- Include necessary Bootstrap or CSS links -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                /* Adjust styles for image or video */
                .media-container {
                    max-width: 100%;
                    height: 700px;
                    justify-content: center;
                }
            </style>
        </head>

        <body>
            <!-- Navigation -->
            <?php 
            include "navigation.php";
            ?>

            <div class="container mt-5">
                <a href="./show_news_admin.php"><button type="button" class="btn btn-primary  float-left m-2 p-3">Back</button></a>
                <h1><?php echo $news['title']; ?></h1>
                <p>Date: <?php echo $news['date']; ?></p>
                <div class="row">
                    <?php
                    if (!empty($news['video_url'])) {
                        echo "<div class='embed-responsive embed-responsive-16by9 media-container'>
                            <video class='embed-responsive-item' width='550px'   controls>
                                <source src='{$news['video_url']}' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                        </div>";
                    } elseif (!empty($news['image_url'])) {
                        echo "<img src='{$news['image_url']}' alt='News Image'  ' class='img-fluid media-container'>";
                    }

                    ?>
                </div>
                <div>
                    <?php
                    $description = $news['description'];
                    $paragraphs = explode("\n", $description);
                    ?>

                    <?php foreach ($paragraphs as $paragraph) : ?>
                        <p><?php echo $paragraph; ?></p>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="button-container mb-5" style="text-align: center;">
                <a href="edit_news.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete_news.php?id=<?php echo $news['id']; ?>" class="btn btn-danger">Delete</a>

                <!-- Button to post the news article -->
                <form action="update_status.php" method="post" style="display: inline;">
                    <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-success">Post</button>
                </form>

                <!-- Button to unpost the news article -->
                <form action="update_status.php" method="post" style="display: inline;">
                    <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
                    <input type="hidden" name="status" value="0">
                    <button type="submit" class="btn btn-warning">Unpost</button>
                </form>
            </div>
            </div>
            <!-- Include necessary JavaScript or scripts -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('No news found with the provided ID.')</script>";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No news ID provided.";
}
?>