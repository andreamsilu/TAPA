<?php
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
                    height: auto;
                }
            </style>
        </head>
        <body>
            <!-- Navigation -->
            <?php include "navigation.php"; ?>

            <div class="container mt-5">
                <h1><?php echo $news['title']; ?></h1>
                <p><?php echo $news['description']; ?></p>
                <p>Date: <?php echo $news['date']; ?></p>
                
                <!-- Display image or video -->
                <?php
                if (!empty($news['video_url'])) {
                    echo "<div class='embed-responsive embed-responsive-16by9 media-container'>
                            <video class='embed-responsive-item' controls>
                                <source src='{$news['video_url']}' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                        </div>";
                } elseif (!empty($news['image_url'])) {
                    echo "<img src='{$news['image_url']}' alt='News Image' class='img-fluid media-container'>";
                }
                ?>
                
                <!-- Add Edit and Delete buttons -->
                <a href="edit_news.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete_news.php?id=<?php echo $news['id']; ?>" class="btn btn-danger">Delete</a>
                <!-- Add Read More functionality if needed -->

            </div>

            <!-- Include necessary JavaScript or scripts -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "No news found with the provided ID.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No news ID provided.";
}
?>
