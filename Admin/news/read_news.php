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

<div class="container mt-5">
    <!-- <h2>All News</h2> -->
    <div class="news-container">
        <?php
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include('connection.php');

        // Fetch all news articles where status is 1, ordered by date (most recent first)
        $sql = "SELECT * FROM news WHERE status = '1' ORDER BY date DESC";
        $result = $conn->query($sql);

        $count = 0; // Initialize a counter

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Start a new row after every four news articles
                if ($count % 4 == 0) {
                    echo "<div class='row mb-5' >";
                }

                echo "<div class='col-md-3'>
                        <div class='card news-card'>";

                // Check if video URL is available for this article
                if (!empty($row['image_url'])) {
                    echo "<img src='Admin/news/{$row['image_url']}' class='card-img-top' alt='News Image'>";
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
                        <h6 class='card-title'>{$row['title']}</h6>
                        <p class='card-text'>";

                // Shorten the description for the preview
                $shortenedDescription = substr($row['description'], 0, 20) . '...';

                echo $shortenedDescription;

                echo "</p>
                        <p class='card-text'><small class='text-muted'>{$row['date']}</small></p>
                        <a href='Admin/news/full_news.php?id={$row['id']}' class='btn btn-primary btn-sm'>Read More</a>
                    </div>
                </div>
            </div>";

                // End the row after every four news articles
                if ($count % 4 == 3) {
                    echo "</div>";
                }

                $count++; // Increment the counter
            }

            // If the last row doesn't have enough news articles to fill four columns
            if ($count % 4 !== 0) {
                echo "</div>";
            }
        } else {
            echo "No news articles found.";
        }

        $conn->close();
        ?>
    </div>
</div>