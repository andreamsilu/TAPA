<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration - TAPA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/tapa.png" rel="icon">
  <link href="assets/img/tapa.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <?php include "header.php" ?>

  <main>
    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Membership Registration</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Membership Registration</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->


    <section id="contact" class="contact">
      <div class="container">
        <h1 class="text-center">Getting started as TAPA member</h1>

        <!-- <div class="row justify-content-center" data-aos="fade-up"> -->
        <!-- <div class="col-lg-10"> -->
        <!-- <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>Esaurp Village, Near Mlimani City<br>Dar es Salaam, Tanzania</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@tapa.or.tz</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+255 719 911 575</p>
                </div>
              </div>
            </div> -->
        <!-- </div> -->
        <!-- </div> -->

        <div class="row mt-2 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form action="forms/register-script.php" method="post" role="form" class="php-email-form">
              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="firstName" class="col-form-label">Full Name</label>
                  <input type="text" name="firstname" class="form-control" id="name" placeholder="Your first name" required>
                </div>

                <!-- <div class="col-md-6 form-group">
                  <label for="lastName" class="col-form-label">Last Name</label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Your lastname" required>
                </div> -->

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="phone" class="col-form-label">Phone</label>
                  <input type="phone" class="form-control" name="phone" id="phone" placeholder="Your phone" required>
                </div>
                <div class="form-group mt-3">
                  <label for="address" class="col-form-label">Postal Address</label>
                  <input type="text" class="form-control" name="address" id="addrress" placeholder="address" required>
                </div>
                <div class="form-group mt-3">
                  <label for="dob" class="col-form-label">Birth date</label>
                  <input type="date" class="form-control" name="dob" id="addrress" placeholder="dob" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="password" class="col-form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="confirm-password" class="col-form-label">Confirm password</label>
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="address" class="col-form-label">Postal Address</label>
                <input type="text" class="form-control" name="address" id="addrress" placeholder="address" required>
              </div>

              <div class="form-group mt-3">
                <label for="membership_type" class="col-form-label">Select Membership category</label>
                <select class="form-control" id="membership_type" name="membership_type" required>
                  <option value="" disabled selected>Select membership category</option>
                  <option value="student">Full Member</option>
                  <option value="associate_one">Associate Member I</option>
                  <option value="associate_two">Associate Member II</option>
                  <option value="student">Student Member </option>
                  <option value="local_affiliate">Local Affiliate Member</option>
                  <option value="foreign_affiliate">Foreign Affiliate Member</option>
                </select>
              </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="licensure" class="col-form-label"> Licensure/Ethics <br> Are you licensed as a psychologist by a state or provincial psychology board outside of Tanzania?</label>
                  <input type="checkbox" name="yes" value="yes"> 
                  <label for="">Yes</label>
                  
                   <input type="checkbox" name="no" value="no">
                  <label for="">No</label>
                  </div>

                  <div class="col-md-6 form-group">
                  <label for="yes_licensure" class="col-form-label">If Yes Mention below</label>
                  <input type="text" name="yes_licensure" class="form-control" id="yes_licensure" placeholder="Your licensure" required>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="licensure" class="col-form-label"> Crimes <br> Have you at any time been convicted of a crime, sanctioned by any professional ethics body, licensing board, regulatory body, professional/scientific organization, or supervisory group for unethical behavior?</label>
                  <input type="checkbox" name="crime_yes" value="yes"> 
                  <label for="">Yes</label>
                  
                   <input type="checkbox" name="crime_no" value="no">
                  <label for="">No</label>
                  </div>

                  <div class="col-md-6 form-group">
                  <label for="yes_licensure" class="col-form-label">If Yes please explain below</label>
                  <!-- <input type="text" name="yes_licensure" class="form-control" id="yes_crime" placeholder="Explain your crime situation" required> -->
                <textarea class="form-control" name="yes_crime" rows="3" placeholder="Explain your crime situation" required></textarea>
                </div>

              <div class="form-group mt-3">
                <label for="cv" class="col-form-label">Upload your CV</label>
                <input type="file" class="form-control" name="cv" id="cv" placeholder="Upload your cv" required>
              </div>
              <div class="form-group mt-3">
                <label for="about" class="col-form-label"><a href="">Read and agree to the Terms and Conditions</a></label><br>
                <input type="checkbox" name="crime_yes" value="yes"> I agree to the terms and condions
              </div>
              <div class="form-group mt-3">
                <h5>Robot Confirmation</h5>
                <label for="about" class="col-form-label">Confirm that you are not robot to continue with registration.....</label><br>
              </div>

              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Register</button></div>

              <div class="form-group mt-3">
                <p class="large mb-0  text-center">Already have account? <a href="login.php">Login Now</a></p>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section>
    <!-- End Contact Section -->
















    <!-- Profile registration Form -->
    <!-- <form action="forms/register.php" method="POST" class="m-5 w-70 align-center" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <label for="firstName" class="col-form-label">First Name</label>
          <input name="firstName" type="text" class="form-control" id="firstName" value="">

          <label for="lastName" class="col-form-label">Last Name</label>
          <input name="lastName" type="text" class="form-control" id="lastName" value="">

          <label for="Email" class="col-form-label">Email</label>
          <input name="email" type="email" class="form-control" id="Email" value="">

          <label for="Phone" class="col-form-label">Phone</label>
          <input name="phone" type="text" class="form-control" id="Phone" value="">

          <label for="password" class="col-form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" value="">

          <label for="password" class="col-form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" value=""> -->

    <!-- <label for="profilepic" class="col-form-label">Upload Profile Picture</label>
          <input name="profilepic" type="file" class="form-control" id="profilepic">

          <label for="region" class="col-form-label">Region</label>
          <input name="region" type="text" class="form-control" id="region" value="">

          <label for="address" class="col-form-label">Address</label>
          <input name="address" type="text" class="form-control" id="address" value="">

          <label for="about" class="col-form-label">About Yourself</label>
          <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea> -->
    <!-- </div> -->

    <!-- <div class="col-md-6">
          <label for="education_level" class="col-form-label">Education Level</label>
          <input type="text" name="education_level" id="education_level" class="form-control">

          <label for="awards" class="col-form-label">Awards</label>
          <input name="awards" type="text" class="form-control" id="awards" value="">

          <label for="institution" class="col-form-label">Institution</label>
          <input name="institution" type="text" class="form-control" id="institution" value="">

          <label for="working_at" class="col-form-label">Current Job</label>
          <input name="working_at" type="text" class="form-control" id="working_at" value="">

          <label for="position" class="col-form-label">Position</label>
          <input name="position" type="text" class="form-control" id="position" value="">

          <br><br>
          <div class="row">
            <div class="text-center">
              <button type="submit" name="submit" class="btn" style="background:#0F718A;"><a href="" class="text-white">Finish Registration</a></button>
            </div>
          </div> -->
    </div>
    </div>
    </form>
    <!-- End Profile registration Form -->
  </main>

  <?php include "footer.php" ?>
</body>

</html>