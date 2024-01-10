<?php
include "navigation.php";
include "../../forms/connection.php";

$selected_date = isset($_GET['selected_date']) ? $_GET['selected_date'] : '';

$total_news_query = "SELECT COUNT(*) AS total FROM news";
$total_news_result = $conn->query($total_news_query);
$total_news = $total_news_result->fetch_assoc()['total'];

$news_per_day_query = "SELECT DATE(date) AS news_date, COUNT(*) AS count_per_day FROM news GROUP BY DATE(date)";
$news_per_day_result = $conn->query($news_per_day_query);

$selected_date_query = "SELECT COUNT(*) AS count_selected_date FROM news WHERE DATE(date) = '$selected_date'";
$selected_date_result = $conn->query($selected_date_query);
$count_selected_date = $selected_date_result->fetch_assoc()['count_selected_date'];

// Query to get news articles for the selected date
$selected_news_query = "SELECT * FROM news WHERE DATE(date) = '$selected_date'";
$selected_news_result = $conn->query($selected_news_query);
?>

<div class="container mt-4">
<h2 class="text-center">Dashboard</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total News Articles</h5>
                    <p class="display-4"><?php echo $total_news; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">News Articles Added Each Day</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $news_per_day_result->fetch_assoc()) {
                                    $news_date = $row['news_date'];
                                    $count_per_day = $row['count_per_day'];
                                    echo "<tr><td>$news_date</td><td>$count_per_day</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if ($selected_date && $count_selected_date !== null) : ?>
                <div class="mt-4 card">
                    <div class="card-body">
                        <h5 class="card-title">Number of News Articles for <?php echo $selected_date; ?></h5>
                        <p><?php echo $count_selected_date; ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <form action="index.php" method="GET">
                <div class="form-group">
                    <label for="datepicker">Filter by Date:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="datepicker" name="selected_date" value="<?php echo $selected_date; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Display news articles for the selected date -->
    <?php if ($selected_date && $selected_news_result->num_rows > 0) : ?>
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>News Articles for <?php echo $selected_date; ?></h4>
            </div>
            <?php while ($article = $selected_news_result->fetch_assoc()) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 100%;">
                        <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="News Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $article['title']; ?></h5>
                            <p class="card-text text-truncate" style="max-height: 50px; overflow: hidden;"><?php echo $article['description']; ?></p>
                            <a href="#" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>




<?php include "footer.php"; ?>
