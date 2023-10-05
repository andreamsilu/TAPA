<?php
include('myprofile.php'); // Include your backend script
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <?php include "titleIcon.php" ?>

<body class="m-3 bg-gradient">

  <?php include "header.php" ?>
  <link href="assets/css/style.css" rel="stylesheet">

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
          <?php include("profile/personal_info.php") ?>
        </div>


        <!-- =============================================================================================== -->
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-education">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Certification&Awards</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#member-fee">Membership Fee</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cvTabsContent">My cv</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>
              </ul>
              
              <!-- =======================================education profile``===================================================== -->
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-education" id="profile-education">
                <?php include("profile/education_profile.php") ?>
           
                </div>

                <!-- =================================certification&awards============================================ -->
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <?php include("profile/certificate_award.php") ?>
                  
                </div>

                <!-- =============================membership fee=========================================== -->
                <div class="tab-pane fade pt-3" id="member-fee">
                  <?php include("profile/member-fee.php") ?>

                </div>


                <!-- ====================================member cv=================================================== -->
                <div class="tab-pane fade pt-3" id="cvTabsContent">
                <?php include("profile/myCv.php") ?>
                  
              </div>

              <!-- =========================change password=================================================================== -->
              <div class="tab-pane fade pt-3" id="profile-change-password">
              <?php include("profile/change-password.php") ?>

               
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

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  // Add an event listener to open the modal when the button is clicked
  document.getElementById("openModalButton").addEventListener("click", function() {
    document.getElementById("educationModal").style.display = "block"; // Display the modal
  });

  // Close the modal when the close button or backdrop is clicked
  document.querySelector(".modal .close").addEventListener("click", function() {
    document.getElementById("educationModal").style.display = "none";
  });

  // Close the modal when the "Close" button is clicked
  document.querySelector(".modal-footer .btn-secondary").addEventListener("click", function() {
    document.getElementById("educationModal").style.display = "none";
  });
</script>
<?php //include "footer.php" 

?>