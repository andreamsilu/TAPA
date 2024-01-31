<?php  include "navigation.php"; ?>
<style>
    /* Additional custom styles as needed */
    .news-card {
        margin-bottom: 30px;
    }
</style>
<div class="container mt-5">
    <h2 class="text-center py-3">All TAPA News</h2>
    <div class="row">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "TAPA_DB";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
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
                if (!empty($row['image_url'])) {
                    echo "<img src='{$row['image_url']}' class='card-img-top' height='250px' width='250px' alt='News Image'>";

                    
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
                        <p class='card-text'>{$row['description']}</p>
                        <p class='card-text'><small class='text-muted'>{$row['date']}</small></p>
                        <a href='edit_news.php?id={$row['id']}' class='btn btn-primary btn-sm mr-2'>Edit</a>
                        <form action='delete_news.php' method='post' style='display: inline-block;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this news article?\");'>Delete</button>
                        </form>
                        <a href='full_news_admin.php?id={$row['id']}' class='btn btn-secondary btn-sm'>Read More</a>
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
<?php include "footer.php"; ?>