<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Single News Post</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .container {
      padding: 50px 15px;
    }
    .news-item {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
    }
    .news-item img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    .news-item h2 {
      font-size: 2em;
      margin-bottom: 10px;
    }
    .news-item p {
      font-size: 1.1em;
      line-height: 1.6;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="news-item">
    <img src="assets/img/tapaImages/slide-1.jpg" alt="News 1">
    <h2>Workshop on Stress Management</h2>
    <p><strong>Date:</strong> December 10, 2023</p>
    <p>
      The Tanzanian Psychological Association conducted a successful workshop focused on stress management techniques for professionals and the general public.
      It covered various aspects of stress, coping mechanisms, and strategies to maintain mental well-being in high-pressure environments.
      Experts from different fields shared their insights, making it an insightful event for all attendees.
    </p>
    <p>
      The workshop emphasized the importance of recognizing stress triggers and adopting healthy practices to alleviate stress.
      Participants engaged in interactive sessions, group discussions, and practical exercises aimed at understanding and managing stress.
    </p>
    <p>
      Overall, the event received positive feedback, and the association plans to conduct similar workshops in the future to support the community's mental health needs.
    </p>
    <a href="index.php" class="btn btn-primary">Back to News</a>
  </div>
</div>

<!-- jQuery and Bootstrap Bundle with Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
