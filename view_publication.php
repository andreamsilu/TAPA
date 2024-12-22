<?php
// Enable error reporting for debugging
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

// Database connection
include 'adminpanel/db.php';

// Check if 'id' parameter is set
if (isset($_GET['id'])) {
    $publication_id = $_GET['id'];

    // Fetch publication details
    $sql = "SELECT * FROM publications WHERE publication_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $publication_id]);
    $publication = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$publication) {
        die('Publication not found!');
    }
} else {
    die('Invalid request!');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Publications- TAPA </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include "titleIcon.php" ?>

</head>

<body>
    <?php include "header.php" ?>


    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Publication & Resources</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Publications & Resources</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->

<style>
    .publication-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 30px rgba(1, 41, 112, 0.08);
        transition: 0.3s;
        background: #fff;
        margin-bottom: 20px;
    }

    .publication-card:hover {
        transform: scale(1.02);
        box-shadow: 0px 4px 30px rgba(1, 41, 112, 0.2);
    }

    .publication-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .publication-details {
        padding: 20px;
    }

    .publication-details h2 {
        margin-bottom: 10px;
        color: #0F718A;
    }

    .publication-details h4 {
        margin-bottom: 15px;
        color: #333;
    }

    .publication-details p {
        font-size: 16px;
        color: #555;
    }

    .download-btn {
        margin-top: 20px;
    }

    /* Flexbox Layout for horizontal arrangement */
    .publication-card .d-flex {
        display: flex;
        flex-wrap: wrap;
    }

    /* Adjusting space for image and content */
    .publication-img {
        max-width: 300px;
        margin-right: 20px;
    }

    .publication-details {
        flex: 1;
    }

    /* Bootstrap Icons Adjustments */
    .btn i {
        margin-right: 8px;
    }
</style>

<div class="container mt-5">
    <div class="publication-card d-flex">
        <?php if (!empty($publication['thumbnail_url'])): ?>
            <img src="adminpanel/<?= htmlspecialchars($publication['thumbnail_url'] ?? 'https://via.placeholder.com/300x300?text=No+Image') ?>" 
                 alt="<?= htmlspecialchars($publication['title'] ?? 'No Title Available') ?>" class="publication-img">
        <?php else: ?>
            <img src="https://via.placeholder.com/300x300?text=No+Image" alt="No Image Available" class="publication-img">
        <?php endif; ?>

        <div class="publication-details">
            <h2><?= htmlspecialchars($publication['title'] ?? 'Untitled Publication') ?></h2>
            <h4><strong>Author</strong> <?= htmlspecialchars($publication['author'] ?? 'Unknown Author') ?></h4>
            <p><strong>Publication Date:</strong> <?= htmlspecialchars($publication['publication_date'] ?? 'Unknown Date') ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($publication['category'] ?? 'Uncategorized') ?></p>
            <p><strong>Tags:</strong> <?= htmlspecialchars($publication['tags'] ?? 'No Tags') ?></p>
            <p><?= nl2br(htmlspecialchars($publication['description'] ?? 'No Description Available')) ?></p>

            <a href="publication-resources.php" class="btn btn-secondary download-btn">
                <i class="bi bi-arrow-left-circle"></i> Back to Publications
            </a>
            <a href="adminpanel/<?= htmlspecialchars($publication['file_url'] ?? '#') ?>" 
               class="btn btn-primary download-btn" target="_blank">
                <i class="bi bi-download"></i> Read & Download
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
