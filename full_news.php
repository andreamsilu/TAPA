<?php
// Database connection
include 'adminpanel/db.php'; 

// Check if the user is authenticated
// if (!isset($_SESSION['email'])) {
//     header("Location: ../../login.php");
//     exit();
// }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* Adjust styles for image or video */
        .media-container {
            max-width: 100%;
            height: 700px;
            justify-content: center;
        }

        /* Styles for back button */
        .back-button {
            position: absolute;
            top: 20px;
            left: 10px;
            z-index: -9999; /* Ensure it's above other content */
        }

        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0F718A;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-bottom: 30px;
        }

        .back-button a:hover {
            background-color: #095C72;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Back button -->
    <!-- <div class="back-button">
        <a href="../../index.php" onclick="hstory.back();">Home</a>
    </div> -->

    <?php
    include('titleIcon.php');
    ?>
    <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="news-page.php"> <h2>Back</h2></a>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Full news</li>
                    </ol>
                </div>

            </div>
        </section>

    <!-- Navigation -->
    <!-- if ($comments) { -->

    <div class="container" style="margin-top:50px">
                <h1 class="text-center"><?php echo $news['title']; ?></h1>
                <p class="text-center">Date: <?php echo $news['date']; ?></p>
                <div class="row">
                    <?php
                    if (!empty($news['video_url'])) {
                        echo "<div class='embed-responsive embed-responsive-16by9 media-container'>
                    <video class='embed-responsive-item' width='550px'   controls>
                        <source src='adminpanel/{$news['video_url']}' type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                </div>";
                    } elseif (!empty($news['image_url'])) {
                        echo "<img src='adminpanel/{$news['image_url']}' alt='News Image'  ' class='img-fluid media-container'>";
                    }
                    ?>
                </div>
                <div class="mt-4">
                    <?php
                    // Explode the description into paragraphs
                    $paragraphs = explode("\n", $news['description']);

                    // Output each paragraph in a <p> tag
                    foreach ($paragraphs as $paragraph) {
                        echo "<p class='text-left    m-1 p-2'>$paragraph</p>";
                    }
                    ?>
                </div>

            </div>
            <!-- Display image or video -->
            <div class="mt-3 text-center">
                <button class="btn btn-primary" onclick="shareNews()">
                    <i class="bi bi-share"></i> Share
                </button>
                <button id="copyButton" class="btn btn-primary">
                    <i class="bi bi-files"></i> Copy Link
                </button>
            </div>

            <script>
                function shareNews() {
                    // Get the news details
                    var newsTitle = '<?php echo $news['title']; ?>';
                    var newsID = '<?php echo $news['id']; ?>';

                    // Create a shareable link with the news ID
                    var shareLink = "http://tapa.or.tz/share-news.php?id=" + encodeURIComponent(newsID);

                    // Check if the Web Share API is supported
                    if (navigator.share) {
                        navigator.share({
                                title: newsTitle,
                                url: shareLink,
                            })
                            .then(() => console.log('Successful share'))
                            .catch((error) => console.log('Error sharing:', error));
                    } else {
                        // You can customize this fallback based on your needs (e.g., open a modal with sharing options)
                        alert("Share this link for '" + newsTitle + "': " + shareLink);
                    }

                    // Enable the "Copy Link" button
                    document.getElementById('copyButton').disabled = false;
                }

                document.getElementById('copyButton').addEventListener('click', function() {
                    // Get the shareable link
                    var shareLink = "https://tapa.or.tz/share-news.php?id=" + encodeURIComponent('<?php echo $news['id']; ?>');

                    // Create a temporary input element
                    var tempInput = document.createElement('input');
                    tempInput.value = shareLink;
                    document.body.appendChild(tempInput);

                    // Select the text in the input element
                    tempInput.select();
                    tempInput.setSelectionRange(0, 99999); /*For mobile devices*/

                    // Copy the text to the clipboard
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);

                    // Display a confirmation message
                    alert('Link copied to clipboard: ' + shareLink);
                });
            </script>



            <!-- Display Comments from Database -->
            <div class="mt-4 text-center">
                <h3>Comments</h3>

                <?php

                // Assume $news_id is the news article ID
                $news_id = $_GET['id'];

                // Fetch comments for the specific news article
                $sql = "SELECT * FROM comments WHERE news_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $news_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are comments
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display comments with styling
                        echo "<div class='comment-container'>";
                        echo "<div class='comment-header'>";
                        echo "<strong>{$row['user_name']}:</strong>";
                        echo "<span class='comment-date'>{$row['created_at']}</span>";
                        echo "</div>";
                        echo "<p class='comment-text'>{$row['comment_text']}</p>";
                        echo "<button class='btn btn-sm btn-primary reply-btn' onclick='showReplyForm({$row['id']})'>Reply</button>";
                        echo "<div class='reply-form' id='replyForm{$row['id']}'>";
                        echo "<form action='post_reply.php' method='post'>";
                        echo "<input type='hidden' name='comment_id' value='{$row['id']}'>";
                        echo "<input type='hidden' name='news_id' value='{$news_id}'>";
                        echo "<label for='user_name'>Your Name:</label>";
                        echo "<input type='text' name='user_name' required>";
                        echo "<label for='reply_comment'>Your Reply:</label>";
                        echo "<textarea name='reply_comment' required></textarea>";
                        echo "<button type='submit' class='btn btn-sm btn-primary'>Post Reply</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No comments yet.</p>";
                }

                $stmt->close();
                // $conn->close();  
                ?>
            </div>

            <!-- Comment Form -->
            <div class="container">
                <form action="post_comment.php" method="post" class="border p-3 rounded m-5">
                    <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">

                    <div class="mb-3">
                        <label for="user_name" class="form-label">Your Name:</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea name="comment" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
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
    // $stmt->close();
    $conn->close();
} else {
    echo "No news ID provided.";
}
?>
<?php include('../../footer.php') ?>