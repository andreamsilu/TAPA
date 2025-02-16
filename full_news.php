<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

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
    $stmt = $conn->prepare("SELECT * FROM news WHERE id = :id");
    $stmt->bindParam(':id', $news_id, PDO::PARAM_INT);  // Use bindParam() with PDO
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Fetch the news article details
        $news = $result;

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
        .media-container {
            max-width: 100%;
            height: 700px;
            justify-content: center;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 10px;
            z-index: -9999; 
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
  <a href="index.php">Home</a>
    <div class="container" style="margin-top:50px">
        <h1 class="text-center"><?php echo $news['title']; ?></h1>
        <p class="text-center">Date: <?php echo $news['date']; ?></p>
        <div class="row">
            <?php
            if (!empty($news['video_url'])) {
                echo "<div class='embed-responsive embed-responsive-16by9 media-container'>
                    <video class='embed-responsive-item' width='550px' controls>
                        <source src='adminpanel/{$news['video_url']}' type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                </div>";
            } elseif (!empty($news['image_url'])) {
                echo "<img src='adminpanel/{$news['image_url']}' alt='News Image' class='img-fluid media-container'>";
            }
            ?>
        </div>
        <div class="mt-4">
            <?php
            $paragraphs = explode("\n", $news['description']);
            foreach ($paragraphs as $paragraph) {
                echo "<p class='text-left m-1 p-2'>$paragraph</p>";
            }
            ?>
        </div>
    </div>

    <div class="mt-3 text-center mb-5">
        <button class="btn btn-primary" onclick="shareNews()">
            <i class="bi bi-share"></i> Share
        </button>
        <button id="copyButton" class="btn btn-primary">
            <i class="bi bi-files"></i> Copy Link
        </button>
    </div>

    <script>
        function shareNews() {
            var newsTitle = '<?php echo $news['title']; ?>';
            var newsID = '<?php echo $news['id']; ?>';
            var shareLink = "http://tapa.or.tz/share-news.php?id=" + encodeURIComponent(newsID);

            if (navigator.share) {
                navigator.share({
                    title: newsTitle,
                    url: shareLink,
                })
                .then(() => console.log('Successful share'))
                .catch((error) => console.log('Error sharing:', error));
            } else {
                alert("Share this link for '" + newsTitle + "': " + shareLink);
            }

            document.getElementById('copyButton').disabled = false;
        }

        document.getElementById('copyButton').addEventListener('click', function() {
            var shareLink = "https://tapa.or.tz/share-news.php?id=" + encodeURIComponent('<?php echo $news['id']; ?>');
            var tempInput = document.createElement('input');
            tempInput.value = shareLink;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Link copied to clipboard: ' + shareLink);
        });
    </script>

    <!-- Comments Section -->
    <!-- <div class="mt-4 text-center">
        <h3>Comments</h3>

        <?php
        // $news_id = $_GET['id'];

        // $sql = "SELECT * FROM comments WHERE news_id = :news_id";
        // $stmt = $conn->prepare($sql);
        // $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
        // $stmt->execute();
        // $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // if ($comments) {
        //     foreach ($comments as $row) {
        //         echo "<div class='comment-container'>";
        //         echo "<div class='comment-header'>";
        //         echo "<strong>{$row['user_name']}:</strong>";
        //         echo "<span class='comment-date'>{$row['created_at']}</span>";
        //         echo "</div>";
        //         echo "<p class='comment-text'>{$row['comment_text']}</p>";
        //         echo "</div>";
        //     }
        // } else {
        //     echo "<p>No comments yet.</p>";
        // }

        // $stmt->closeCursor();
        ?>
    </div>

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
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    } else {
        echo "No news found with the provided ID.";
    }

    $conn = null;  // Close the database connection
} else {
    echo "No news ID provided.";
}
?>
<?php include('footer.php') ?>
