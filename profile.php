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
              <h2 class="text-center">Personal information</h2>
              <img src="https://via.placeholder.com/120" alt="Default Avatar" style="max-width: 120px;" class="rounded-circle">
              <h2><?php echo $firstname . " " . $lastname ?></h2>

              <h3> <span>Full Name:</span><?php echo $firstname . " " . $lastname ?></h3>
              <h3> <span>Email:</span><?php echo $email ?></h3>
              <h3> <span>Phone:</span><?php echo $phone ?></h3>
              <h3> <span>Address:</span><?php echo $address ?></h3>




            </div>



          </div>

        </div>

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
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-education" id="profile-education">
                  <div class="container mt-5">
                    <div class="container mt-5">
                      <div class="container mt-5">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="card-title"><i class="bi bi-graduation-cap"></i> Education</h5>
                            <button class="btn btn-primary" id="openModalButton">ADD</button>
                            <button class="btn btn-gradient" id="openModalButton">Edit</button>
                          </div>
                        </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="educationModalLabel"> <i class="bi bi-graduation-cap"></i>Add Education Information</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <!-- Your education information form goes here -->
                              <div class="container mt-5">
                                <form>
                                  <div class="form-group">
                                    <label for="courseTitle"><span> <i class="fas fa-graduation-cap"></i></span> Title</label>
                                    <input type="text" class="form-control" id="courseTitle" placeholder="E.g. BSc in Engineering">
                                  </div>
                                  <div class="form-group">
                                    <label for="qualificationCategory">Qualification Category</label>
                                    <select class="form-control" id="qualificationCategory">
                                      <option value="Accounting - H011, H411">Accounting - H011, H411</option>
                                      <option value="Accounting and Business Administration">Accounting and Business Administration</option>
                                      <!-- Add more options here -->
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level">
                                  </div>
                                  <div class="form-group">
                                    <label for="countryOfInstitution">Country of Institution</label>
                                    <input type="text" class="form-control" id="countryOfInstitution">
                                  </div>
                                  <div class="form-group">
                                    <label for="institution">Institution</label>
                                    <input type="text" class="form-control" id="institution">
                                  </div>
                                  <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                  </div>
                                  <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" class="form-control" id="endDate">
                                  </div>
                                  <div class="form-group">
                                    <label for="currentlyStudyingAt">Currently Studying At</label>
                                    <input type="text" class="form-control" id="currentlyStudyingAt">
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
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

                <div class="tab-pane fade pt-3" id="member-fee">

                  <!-- Settings Form -->
                  <div class="container mt-5">
  <!-- Tab Structure -->
  <ul class="nav nav-tabs" id="feeTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="fee-tab" data-toggle="tab" href="#fee" role="tab" aria-controls="fee" aria-selected="true">Membership Fee</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment Status</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="add-payment-tab" data-toggle="tab" href="#add-payment" role="tab" aria-controls="add-payment" aria-selected="false">Add Payment</a>
    </li>
  </ul>
  <div class="tab-content" id="feeTabsContent">
    <!-- Membership Fee Tab Pane -->
    <div class="tab-pane fade show active" id="fee" role="tabpanel" aria-labelledby="fee-tab">
      <div class="container">
        <h2 class="mt-4">Membership Fee Page</h2>
        <hr>
        <h3>Membership Fee Details</h3>
        <p>Membership Type: Premium</p>
        <p>Fee Amount: $100 per year</p>
        <p>Payment Due Date: January 15th</p>
        <!-- Add more membership fee details here -->
      </div>
    </div>
    <!-- Payment Status Tab Pane -->
    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
      <div class="container">
        <h2 class="mt-4">Payment Status</h2>
        <hr>
        <p>Payment Status: Paid</p>
        <p>Payment Date: January 10th</p>
        <!-- Add more payment status details here -->
      </div>
    </div>
    <!-- Add Payment Tab Pane -->
    <div class="tab-pane fade" id="add-payment" role="tabpanel" aria-labelledby="add-payment-tab">
      <div class="container">
        <h2 class="mt-4">Add Payment</h2>
        <hr>
        <!-- Payment form goes here -->
        <form>
          <div class="form-group">
            <label for="paymentAmount">Payment Amount</label>
            <input type="text" class="form-control" id="paymentAmount" placeholder="Enter payment amount">
          </div>
          <div class="form-group">
            <label for="paymentDate">Payment Date</label>
            <input type="date" class="form-control" id="paymentDate">
          </div>
          <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Tab Structure -->
</div>


                      <!-- End settings Form -->
                    </div>

                    <div class="tab-pane fade pt-3" id="cvTabsContent">
                      <div class="tab-pane fade show active" id="cv" role="tabpanel" aria-labelledby="cv-tab">
                        <div class="container">
                          <h2 class="mt-4">Curriculum Vitae (CV)</h2>
                          <hr>
                          <div class="row">
                            <div class="col-md-6">
                              <h3>Personal Information</h3>
                              <p>Name: <?php echo $firstname . " " . $lastname ?></p>
                              <p>Email: <?php echo $email ?></p>
                              <p>Phone: <?php echo $phone ?></p>
                              <p>Address: <?php echo $address ?></p>
                            </div>
                            <div class="col-md-6">
                              <img src="https://via.placeholder.com/120" alt="Default Avatar" style="max-width: 120px; margin-left:150px;margin-top:50px" class="avatar">
                            </div>
                          </div>
                          <hr>
                          <h3>Education</h3>
                          <p>BSc in Engineering</p>
                          <p>University of Example</p>
                          <p>Graduated: 2020</p>
                          <!-- Add more education details here -->
                          <hr>
                          <h3>Work Experience</h3>
                          <p>Software Engineer</p>
                          <p>Example Company</p>
                          <p>Duration: 2018-2021</p>
                          <!-- Add more work experience details here -->
                        </div>
                      </div>
                    </div>
                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="profile/change-password.php" method="POST">

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