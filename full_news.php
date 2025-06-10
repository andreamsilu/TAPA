<?php
include('titleIcon.php');
include('header.php');
include('forms/connection.php');
?>
<link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = intval($_GET['id']);
                        
                        // Fetch news details
                        $query = "SELECT * FROM news WHERE id = ? AND status = 'published'";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result && $result->num_rows > 0) {
                            $news = $result->fetch_assoc();
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title"><?= htmlspecialchars($news['title']) ?></h1>
                                    <p class="text-muted">Published: <?= date('F j, Y', strtotime($news['created_at'])) ?></p>
                                    
                                    <?php if (!empty($news['image_url'])): ?>
                                        <img src="uploads/news/<?= htmlspecialchars($news['image_url']) ?>" 
                                             alt="News Image" class="img-fluid mb-3">
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($news['video_url'])): ?>
                                        <div class="mb-3">
                                            <video controls class="w-100">
                                                <source src="uploads/news/<?= htmlspecialchars($news['video_url']) ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="news-content">
                                        <?= nl2br(htmlspecialchars($news['content'])) ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo '<div class="alert alert-warning">News article not found or not published.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">No news ID provided.</div>';
                    }
                    ?>
                    
                    <div class="mt-4">
                        <a href="news-page.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to News
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
