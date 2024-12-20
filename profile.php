<!DOCTYPE html>
<html lang="en">
<?php include("titleIcon.php") ?>

<head>
  <meta charset="UTF-8">
  <title>Full Height Bootstrap Page with Three Columns</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .full-height {
      height: 100%;
    }

    .scrollable {
      height: 100%;
      overflow-y: auto;
    }

    .cover-img {
      background-size: cover;
      background-position: center;
      width: 200px;
      /* Adjust size as needed */
      height: 150px;
      /* Adjust size as needed */
      border-radius: 10%;
      overflow: hidden;
      margin: 0 auto;
    }

    .profile-image {
      /* display: block; */
      width: 100%;
      height: auto;
    }
  </style>
</head>

<body class="d-flex align-items-stretch">
<?php include("header.php") ?>


  <!-- First Column for Profile -->
  <div class="col-md-3 col-xl-3 ">
    <div class="sidebar left" style="top: 101px; margin-top:20px">
      <div class="box white text-center profile-edit">
        <div class="cover-img ronded-pic" style="background-image: url('assets/img/login/login-bg2.jpg');">
          <img src="assets/img/tapa/person1.png" alt="user default image" class="rounded-circle img-fluid profile-image">
        </div>
        <h3>Andrea Msilu</h3>
        <p class="gray"></p>
        <p class="gray mb-0"></p>
        <a href="profile_navigation.php" class="btn btn-outline-secondary">Edit Profile</a>
      </div>

      <div class="card bg-light mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title mb-0">Profile Progress</h5>
          <span class="badge bg-primary rounded-pill">13%</span>
        </div>
        <div class="card-body">
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="card-text text-center mb-0">Complete your profile to unlock features and personalize your experience.</p>
        </div>
      </div>

    </div>

  </div>


  </div>

  <!-- Second Column for Recently Scrollable Updates -->
  <div class="col-md-6 bg-info">
    <div class="full-height p-4 scrollable overflow-auto">
      <h2>Recently Scrollable Updates</h2>

      <div class="card border-0 mb-3">
        <img src="assets/img/tapa/A2930-History-and-evolution-of-spacial-psychology.jpg" class="card-img-top" alt="Placeholder Image">
        <div class="card-body">
          <h5 class="card-title">Update Title</h5>
          <p class="card-text">Update Description</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">Posted by: Name</span>
            <span class="text-muted">Date: 2023-12-14</span>
          </div>
        </div>
      </div>

      <div class="card border-0 mb-3">
        <img src="assets/img/tapa/person1.png" class="card-img-top" alt="Update 1 Image">
        <div class="card-body">
          <h5 class="card-title">Update 1 Title</h5>
          <p class="card-text">Update 1 Description</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">Posted by: John Doe</span>
            <span class="text-muted">Date: 2023-12-13</span>
          </div>
        </div>
      </div>

      <div class="card border-0 mb-3">
        <img src="assets/img/tapaImages/slide-1.jpg" class="card-img-top" alt="Update 1 Image">
        <div class="card-body">
          <h5 class="card-title">Update 1 Title</h5>
          <p class="card-text">Update 1 Description</p>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">Posted by: John Doe</span>
            <span class="text-muted">Date: 2023-12-13</span>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Third Column for Available Ongoing Projects -->
  <div class="col-md-3 bg-secondary">
    <div class="full-height p-4 overflow-auto">
      <h2>Recent Psychology Updates</h2>

      <div class="card mb-3">
        <img src="assets/img/meditation.jpg" class="card-img-top" alt="Mindfulness Meditation">
        <div class="card-body">
          <h5 class="card-title">Mindfulness Meditation: Reduce Stress & Improve Focus</h5>
          <p class="card-text">Discover how 10 minutes of daily meditation can decrease stress, enhance focus, and boost your overall well-being. Learn simple techniques and guided practices today!</p>
          <a href="more-about-meditation.html" class="btn btn-sm btn-primary rounded-pill">Read More</a>
        </div>
      </div>

      <div class="card mb-3">
        <img src="assets/img/social-connections.jpg" class="card-img-top" alt="Positive Relationships">
        <div class="card-body">
          <h5 class="card-title">The Power of Positive Relationships for Mental Health</h5>
          <p class="card-text">Explore how strong social connections impact mental health and well-being. Learn how to build and nurture meaningful relationships in your life.</p>
          <a href="building-positive-relationships.html" class="btn btn-sm btn-primary rounded-pill">Read More</a>
        </div>
      </div>

      <div class="card mb-3">
        <img src="assets/img/brain-diagram.jpg" class="card-img-top" alt="Brain Training">
        <div class="card-body">
          <h5 class="card-title">Enhance Your Memory & Cognitive Skills: Brain Training Tips</h5>
          <p class="card-text">Discover effective brain training exercises and strategies to improve memory, focus, and cognitive flexibility. Learn how to keep your mind sharp and agile.</p>
          <a href="brain-training-exercises.html" class="btn btn-sm btn-primary rounded-pill">Read More</a>
        </div>
      </div>

      <div class="card mb-3">
        <img src="assets/img/anxiety-symptoms.jpg" class="card-img-top" alt="Understanding Anxiety">
        <div class="card-body">
          <h5 class="card-title">Understanding Anxiety: Symptoms, Causes & Management</h5>
          <p class="card-text">Learn about the common symptoms and causes of anxiety. Explore effective coping mechanisms and self-management techniques to reduce anxiety and improve well-being.</p>
          <a href="anxiety-management-tips.html" class="btn btn-sm btn-primary rounded-pill">Read More</a>
        </div>
      </div>

      <div class="card mb-3">
        <img src="assets/img/nature-therapy.jpg" class="card-img-top" alt="Nature for Mental Health">
        <div class="card-body">
          <h5 class="card-title">Nature Therapy: The Benefits of Spending Time Outdoors</h5>
          <p class="card-text">Discover the science behind the positive impact of nature on mental health. Explore ways to incorporate nature walks and outdoor activities into your routine for enhanced well-being.</p>
          <a href="benefits-of-nature-therapy.html" class="btn btn-sm btn-primary rounded-pill">Read More</a>
        </div>
      </div>

    </div>

</div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>