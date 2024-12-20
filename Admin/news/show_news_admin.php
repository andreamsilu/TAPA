<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
?>
<style>
    /* Additional custom styles as needed */
    .news-card {
        margin-bottom: 20px;
        height: 400px;
        /* Set a fixed height for the cards */
    }

    .news-card img {
        height: 250px;
        /* Set a fixed height for the images */
        width: 100%;
        /* Ensure images take full width of the card */
        object-fit: cover;
        /* Maintain aspect ratio and cover the entire card */
    }

    .news-container {
        margin-top: 20px;
    }
</style>
<?php
include "navigation.php";
?>
<a href="./full_news_admin.php"></a>
<div class="container mt-5">
    <!-- <h2>All News</h2> -->
    <div class="news-container">
        <?php
        // Database connection
        include('../../forms/connection.php');
        // Check if the user is authenticated
        if (!isset($_SESSION['email'])) {
            header("Location: ../../login.php");
            exit();
        }

        // Fetch all news articles ordered by date (most recent first)
        $sql = "SELECT * FROM news ORDER BY date DESC";
        $result = $conn->query($sql);

        $count = 0; // Initialize a counter

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Start a new row after every four news articles
                if ($count % 3 == 0) {
                    echo "<div class='row'>";
                }

                echo "<div class='col-md-4'>
                <a href='./full_news_admin.php?id={$row['id']}'>
              <div class='card news-card'>";

                // Check if video URL is available for this article
                if (!empty($row['image_url'])) {
                    echo "<img src='{$row['image_url']}' class='card-img-top' alt='News Image'>";
                } else {
                    // Display the image if no video URL is available
                    echo "<div class='embed-responsive embed-responsive-16by9'>
                            <video class='embed-responsive-item' controls>
                                <source src='{$row['video_url']}' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                        </div>";
                }

                echo "<div class='card-body'>
                        <h5 class='card-title'>{$row['title']}</h5>
                        <p class='card-text'>";

                // Shorten the description for the preview
                $shortenedDescription = substr($row['description'], 0, 20) . '...';

                echo $shortenedDescription;

                echo "</p>
                 <a href='edit_news.php?id={$row['id']}' class='btn btn-primary btn-sm mr-2'>Edit</a>
                        <form action='delete_news.php' method='post' style='display: inline-block;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this news article?\");'>Delete</button>
                        </form>
                        <p class='card-text'>
                        <small class='text-muted'>";
                if ($row['status'] == '1') {
                    echo "<i class='fas fa-check-circle text-success'></i> Posted";
                } else {
                    echo "<i class='fas fa-times-circle text-danger'></i> Unposted";
                }
                echo "</small>
                </p>

                <p class='card-text'><small class='text-muted'>{$row['date']}</small></p>
                <a href='full_news_admin.php?id={$row['id']}' class='btn btn-primary btn-sm'>Read More</a>
                </a>
    </div>
</div>
</div>"

        ?>

        <?php
                // End the row after every four news articles
                if ($count % 3 == 3) {
                    echo "</div>";
                }

                $count++; // Increment the counter
            }

            // If the last row doesn't have enough news articles to fill four columns
            if ($count % 3 !== 0) {
                echo "</div>";
            }
        } else {
            echo "No news articles found.";
        }

        $conn->close();
        ?>
    </div>
</div>

<?php include "footer.php"; ?>