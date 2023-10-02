<?php
session_start();
include('connection.php'); // Include your database connection script

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php"); // Replace with your login page URL
  exit();
}

// Fetch user details based on their session user_id
$user_id = $_SESSION['user_id'];
$sql = "SELECT firstname, lastname, email, phone, address, about FROM members WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $firstname = $row["firstname"];
  $lastname = $row["lastname"];
  $email = $row["email"];
  $phone = $row["phone"];
  $address = $row["address"];
  $about = $row["about"];
} else {
  // Handle the case where the user's details couldn't be retrieved
  // You can redirect to an error page or display an error message
  echo "User details not found.";
  exit();
}

$stmt->close();

// Check if the edit form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editProfile"])) {
  // Process the form data for editing
  $newFirstname = sanitizeInput($_POST["newFirstname"]);
  $newLastname = sanitizeInput($_POST["newLastname"]);
  $newEmail = sanitizeInput($_POST["newEmail"]);
  $newPhone = sanitizeInput($_POST["newPhone"]);
  $newAddress = sanitizeInput($_POST["newAddress"]);
  $newAbout = sanitizeInput($_POST["newAbout"]);

  // Update user details in the database
  $updateSql = "UPDATE members SET firstname=?, lastname=?, email=?, phone=?, address=?, about=? WHERE id=?";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("ssssssi", $newFirstname, $newLastname, $newEmail, $newPhone, $newAddress, $newAbout, $user_id);

  if ($updateStmt->execute()) {
    // Update successful, refresh the page
    $successMessage = "login succesfull";
    header("Location: profile.php");
    exit();
  } else {
    // Handle the case where the update fails
    $editError = "Error updating user details.";
  }

  $updateStmt->close();
}

// Function to sanitize user input
function sanitizeInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

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

          <div class="card">
            <div class="card-body profile-card  pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/team/team-1.jpg" alt="Profile" style="max-width: 120px;" class="rounded-circle ">
              <h2><?php echo $firstname . " " . $lastname ?></h2>
              <h3><?php //echo $job 
                  ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full name</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $firstname . " " . $lastname; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $phone; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $address; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">About me</div>
                    <div class="col-lg-9 col-md-8"><?php echo $about; ?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="profile.php">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo $about; ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="organization" class="col-md-4 col-lg-3 col-form-label">Organization</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="neworganization" type="text" class="form-control" id="organization" value="<?php echo $organization; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newJob" type="text" class="form-control" id="job" value="<?php echo $job; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newCountry" type="text" class="form-control" id="country" value="<?php echo $country; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newAddress" type="text" class="form-control" id="address" value="<?php echo $address; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPhone" type="text" class="form-control" id="phone" value="<?php echo $phone; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newEmail" type="email" class="form-control" id="email" value="<?php echo $email; ?>">
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
    <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
    <div class="col-md-8 col-lg-9">
      <input name="newTwitter" type="text" class="form-control" id="twitter" value="<?php //echo $twitter; 
                                                                                    ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
    <div class="col-md-8 col-lg-9">
      <input name="newFacebook" type="text" class="form-control" id="facebook" value="<?php //echo $facebook; 
                                                                                      ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
    <div class="col-md-8 col-lg-9">
      <input name="newInstagram" type="text" class="form-control" id="instagram" value="<?php //echo $instagram; 
                                                                                        ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">LinkedIn Profile</label>
    <div class="col-md-8 col-lg-9">
      <input name="newLinkedin" type="text" class="form-control" id="linkedin" value="<?php //echo $linkedin; 
                                                                                      ?>">
    </div>
  </div> -->

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="editProfile">Save Changes</button>
                    </div>
                  </form>


                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullname" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                  <!-- End settings Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="profile/change-password.php" method="POST" >

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>
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
<?php include "footer.php" ?>