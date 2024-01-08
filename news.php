<?php //include "Admin/news/navigation.php";
include "titleIcon.php";
?>
<style>
    /* Additional custom styles as needed */
    .news-card {
        margin-bottom: 20px;
    }
</style>
<div class="container mt-5">
    <h2>All News</h2>
    <div class="row">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // Database connection
        include "forms/connection.php";

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch all news articles ordered by date (most recent first)
        $sql = "SELECT * FROM news ORDER BY date DESC";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>
                        <div class='card news-card'>";
        
                // Check if video URL is available for this article
                if (!empty($row['video_url'])) {
                    echo "<div class='embed-responsive embed-responsive-16by9'>
                            <video class='embed-responsive-item' controls>
                                <source src='Admin/news/{$row['video_url']}' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                        </div>";
                } else {
                    // Display the image if no video URL is available
                    echo "<img src='Admin/news/{$row['image_url']}' class='card-img-top' alt='News Image'>";
                }
        
                echo "<div class='card-body'>
                        <h5 class='card-title'>{$row['title']}</h5>
                        <p class='card-text'>{$row['description']}</p>
                        <p class='card-text'><small class='text-muted'>{$row['date']}</small></p>
                        <a href='news/edit_news.php?id={$row['id']}' class='btn btn-primary btn-sm mr-2'>Edit</a>
                        <form action='news/delete_news.php' method='post' style='display: inline-block;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this news article?\");'>Delete</button>
                        </form>
                        <a href='news/full_news.php?id={$row['id']}' class='btn btn-secondary btn-sm'>Read More</a>
                    </div>
                </div>
            </div>";
            }
        } else {
            echo "No news articles found.";
        }
    
        

        $conn->close();
        ?>
    </div>
</div>