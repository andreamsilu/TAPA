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
        <?php include 'adminpanel/db.php'; ?>

        <div class="container mt-3 mb-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Publications</h4>
                </div>
                <div class="card-body">
                    <!-- <a href="create_publication.php" class="btn btn-success mb-3">Add New Publication</a> -->

                    <!-- Search and Sorting Controls -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Search by title or author...">
                        </div>
                        <div class="col-md-6 text-end">
                            <select id="sortSelect" class="form-select w-auto d-inline-block">
                                <option value="date_desc">Sort by Date (Newest)</option>
                                <option value="date_asc">Sort by Date (Oldest)</option>
                                <option value="title_asc">Sort by Title (A-Z)</option>
                                <option value="title_desc">Sort by Title (Z-A)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Publications Display -->
                    <div id="publicationsContainer" class="row">

                        <?php
                        $sql = "SELECT * FROM publications ORDER BY publication_date DESC";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($publications as $publication) {
                            // Get the file and thumbnail paths
                            $thumbnail_path = $publication['thumbnail_url'];
                            $file_path = $publication['file_url'];

                            // Check if a thumbnail exists, if not, show a placeholder
                            if ($thumbnail_path) {
                                $extension = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                    $thumbnail_display = "<img src='adminpanel/{$thumbnail_path}' class='card-img-top' alt='Publication Thumbnail'>";
                                } elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogv'])) {
                                    $thumbnail_display = "<video class='card-img-top' controls><source src='{$thumbnail_path}' type='video/" . strtolower($extension) . "'>Your browser does not support the video tag.</video>";
                                }
                            } else {
                                $thumbnail_display = "<img src='path/to/placeholder-image.jpg' class='card-img-top' alt='No Thumbnail'>";
                            }

                            // Fetch the description (truncate it for preview)
                            $description = strlen($publication['description']) > 10 ? substr($publication['description'], 0, 50) . '...' : $publication['description'];

                            echo "
                    <div class='col-md-4 mb-4 publication-card' data-title='{$publication['title']}' data-author='{$publication['author']}' data-date='{$publication['publication_date']}'>
                        <div class='card h-100'>
                            {$thumbnail_display}
                            <div class='card-body'>
                                <h5 class='card-title'>{$publication['title']}</h5>
                                <p class='card-text'>Author: {$publication['author']}</p>
                                <p class='card-text'>Date: {$publication['publication_date']}</p>
                                <p class='card-text'>Description:{$description}</p>
                            </div>
                            <div class='card-footer'>
                                <a href='view_publication.php?id={$publication['publication_id']}' class='btn btn-info btn-sm'>Read More</a>
                            </div>
                        </div>
                    </div>
                    ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php' ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                const sortSelect = document.getElementById('sortSelect');
                const publicationsContainer = document.getElementById('publicationsContainer');

                // Filter Publications by Search
                searchInput.addEventListener('input', function () {
                    const searchText = searchInput.value.toLowerCase();
                    const cards = document.querySelectorAll('.publication-card');
                    cards.forEach(card => {
                        const title = card.getAttribute('data-title').toLowerCase();
                        const author = card.getAttribute('data-author').toLowerCase();
                        if (title.includes(searchText) || author.includes(searchText)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });

                // Sort Publications
                sortSelect.addEventListener('change', function () {
                    const sortValue = sortSelect.value;
                    const cards = Array.from(document.querySelectorAll('.publication-card'));
                    cards.sort((a, b) => {
                        let valueA, valueB;

                        switch (sortValue) {
                            case 'date_asc':
                                valueA = a.getAttribute('data-date');
                                valueB = b.getAttribute('data-date');
                                return new Date(valueA) - new Date(valueB);
                            case 'date_desc':
                                valueA = a.getAttribute('data-date');
                                valueB = b.getAttribute('data-date');
                                return new Date(valueB) - new Date(valueA);
                            case 'title_asc':
                                valueA = a.getAttribute('data-title').toLowerCase();
                                valueB = b.getAttribute('data-title').toLowerCase();
                                return valueA.localeCompare(valueB);
                            case 'title_desc':
                                valueA = a.getAttribute('data-title').toLowerCase();
                                valueB = b.getAttribute('data-title').toLowerCase();
                                return valueB.localeCompare(valueA);
                        }
                    });

                    publicationsContainer.innerHTML = '';
                    cards.forEach(card => publicationsContainer.appendChild(card));
                });
            });
        </script>