
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php include "titleIcon.php" ?>
  <link href="assets/css/style.css" rel="stylesheet">
  <?php include "header.php";
  include "forms/myprofile.php";

  ?>
</head>

<body class="m-3 bg-gradient">
  <main id="main" class="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Member Profile</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Member Profile</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <?php include("profile/personal_info.php"); ?>
        </div>

        <!-- =============================================================================================== -->
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="profileTabs">
                <li class="nav-item">
                  <a class="nav-link active show" data-bs-toggle="tab" href="#profile-education">Education</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#certificate">Certification & Awards</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#member-fee">Membership Fee</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#cv">My CV</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#change-password">Change Password</a>
                </li>
              </ul>

              <!-- =======================================education profile===================================================== -->
              <div class="tab-content pt-2">
                <div class="tab-pane fade" id="profile-education">
                  <?php include("profile/education_profile.php"); ?>
                </div>

                <!-- =================================certification&awards============================================ -->
                <div class="tab-pane fade" id="certificate">
                  <?php include("profile/certificate_award.php"); ?>
                </div>

                <!-- =============================membership fee=========================================== -->
                <div class="tab-pane fade" id="member-fee">
                  <?php include("profile/member-fee.php"); ?>
                </div>

                <!-- ====================================member cv=================================================== -->
                <div class="tab-pane fade" id="cv">
                  <?php  include("profile/myCv.php"); ?>
                </div>

                <!-- =========================change password=================================================================== -->
                <div class="tab-pane fade" id="change-password">
                  <?php //include("profile/change-password.php"); ?>
                  <h1>hello passw0rd</h1>
                  <!-- End Change Password Form -->
                </div>
              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

  <script>
    // Initialize the tab component
    var profileTabs = new bootstrap.Tab(document.getElementById('profileTabs'));
    profileTabs.show();
  </script>

  <?php include "footer.php"; ?>
</body>
</html>
