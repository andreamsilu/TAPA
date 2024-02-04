<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/tapa.png" rel="icon">
  <link href="assets/img/tapa.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->
  <!-- Template Main CSS File -->
  <!-- <link href="test1.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->

</head>
<style>
  /* Registration Section */
  .registration {
    padding: 60px 0;
    background-color: #eee;
    font-family: 'Roboto', Sans-serif;
  }



  .registration h1 {
    font-size: 36px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    color: #0F718A;
  }

  .registration .form-control {
    border: #0c5b6d solid 1px;
    color: #000;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: auto;
    transition: background-color 0.3s;
  }

  .registration label {
    color: #0F718A;
    font-weight: 600;
  }



  .registration button[type="submit"] {
    color: #0F718A;
    border: solid #0F718A 2px;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 200px;
  }

  .registration button[type="submit"]:hover {
    background-color: #0c5b6d;
    color: #eee;
  }

  .form-control:hover {
    color: #000;
    border: #0c5b6d solid 2px;
  }


  .registration placeholder:hover {
    color: #eee;
  }

  .registration .form-group {
    margin-bottom: 20px;
  }

  .registration a {
    color: #0F718A;
  }



  .registration p {
    color: #000;
  }

  .registration a:hover {
    text-decoration: underline;
    color: #0c5b6d;
  }

  .btn-terms {
    color: #0c5b6d;
    border: solid #0c5b6d 2px;
    border-radius: 5px;

  }

  .btn-terms button[type=button]:hover {
    color: #eee;
    border: solid #0c5b6d 2px;
    border-radius: 5px;
    background-color: #0F718A;
  }
</style>

<body>
  <?php
   include "titleIcon.php" ;
   include "header.php" 

  
  ?>

  <main>
    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Membership registration</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Membership registration</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= registration Section ======= -->
    <section id="ragistration" class="registration">
  <div class="container">
    <div class="row mt-2 justify-content-center" data-aos="fade-up">
      <form action="forms/register-script.php" method="post" role="form" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-6 form-group">
            <label for="fullname" class="col-form-label"><i class="bi bi-person"></i> Full Name</label>
            <input type="text" name="fullname" class="form-control" id="name" placeholder="Your full name" required>
          </div>

          <div class="col-md-6 form-group mt-3 mt-md-0">
            <label for="email" class="col-form-label"><i class="bi bi-envelope"></i> Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <label for="phone" class="col-form-label"><i class="bi bi-telephone"></i> Phone</label>
            <input type="phone" class="form-control" name="phone" id="phone" placeholder="Your phone" required>
          </div>

          <div class=" col-md-6 form-group mt-3 mt-md-0">
            <label for="postal_address" class="col-form-label"><i class="bi bi-house-door"></i> Postal Address</label>
            <input type="text" class="form-control" name="postal_address" id="postal_addrress" placeholder="Postal address" required>
          </div>
        </div>

        <div class="form-group mt-3 mt-md-0">
          <label for="birth_date" class="col-form-label"><i class="bi bi-calendar"></i> Birth date</label>
          <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Birthdate" required>
        </div>

        <div class="row">
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <label for="physical_address" class="col-form-label"><i class="bi bi-house"></i> Physical Address</label>
            <input type="text" class="form-control" name="pysical_address" id="physical_addrress" placeholder="Physical address" required>
          </div>

          <div class="col-md-6 form-group mt-3 mt-md-0">
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
        </div>

        <div class="row">
          <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="licensure" class="col-form-label">Licensure/Ethics <br> Are you licensed as a psychologist by a state or provincial psychology board outside of Tanzania?</label>
              <div>
                <input type="radio" name="licensure" value="yes" id="licensure_yes" required>
                <label for="licensure_yes">Yes</label>
              </div>
              <div>
                <input type="radio" name="licensure" value="no" id="licensure_no" required>
                <label for="licensure_no">No</label>
              </div>
            </div>

            <div class="col-md-6 form-group">
              <label for="yes_licensure" class="col-form-label"><i class="bi bi-check2"></i> If Yes, Mention below</label>
              <input type="text" name="yes_licensure" class="form-control" id="ye_licensure" placeholder="Your licensure">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="crimes" class="col-form-label"> Crimes <br> Have you at any time been convicted of a crime, sanctioned by any professional ethics body, licensing board, regulatory body, professional/scientific organization, or supervisory group for unethical behavior?</label>
              <div>
                <input type="radio" name="crime" value="yes" id="crime_yes" required>
                <label for="crime_yes">Yes</label>
              </div>
              <div>
                <input type="radio" name="crime" value="no" id="crime_no" required>
                <label for="crime_no">No</label>
              </div>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="yes_crime" class="col-form-label"><i class="bi bi-exclamation-triangle"></i> If Yes, please explain below</label>
              <textarea class="form-control" name="yes_crime" rows="3" placeholder="Explain your crime situation" ></textarea>
            </div>
          </div>

          <div class=" col-md-6 form-group mt-3 mt-md-0">
            <label for="cv" class="col-form-label"><i class="bi bi-file-earmark-pdf"></i> Upload your CV</label>
            <input type="file" class="form-control" name="cv" id="cv" placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
            <small class="text-muted">Accepted file formats: PDF, DOC, DOCX</small>
          </div>

          <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="password" class="col-form-label"><i class="bi bi-lock"></i> Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required minlength="8">
              <small class="text-muted">Minimum length: 8 characters</small>
            </div>

            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="confirm-password" class="col-form-label"><i class="bi bi-lock"></i> Confirm password</label>
              <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password" required minlength="8">
            </div>
          </div>


          <div class="form-group mt-3">
            <button type="button" class="bt btn-terms" data-toggle="modal" data-target="#termsModal">
              <i class="bi bi-file-earmark-text"></i> Read the terms and conditions
            </button><br><br>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="crime_yes" value="yes">
              <label class="form-check-label"><i class="bi bi-check-square"></i> I agree to the terms and conditions</label>
            </div>
          </div>

          <div class="text-center">
            <button type="submit"><i class="bi bi-person-plus"></i> Register</button>
          </div>

          <div class="form-group mt-3">
            <p class="large mb-0" style="text-align: center; font-size:x-large">Already have an account? <a href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login Now</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- End registration Section -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- End Profile registration Form -->
</main>


  <!-- Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p></strong>
            Welcome to the Tanzania Association of Psychologists (TAPA) website. By accessing and using
            this website, you accept and agree to comply with the following terms and conditions: <br>

            <strong>Website Usage:</strong> The content provided on this website is for informational purposes only. It should not be considered as professional advice or a substitute for professional consultation with qualified psychologists or mental health professionals. <br>

            <strong>Accuracy of Information: </strong>We strive to ensure the accuracy and reliability of the information presented on this website. However, we do not warrant the completeness, correctness, or suitability of the information for any purpose. <br>

            <strong>User Responsibilities:</strong> Users of this website are responsible for their actions and the use of information obtained from the site. TAPA shall not be held liable for any direct or indirect damages resulting from the use or misuse of information provided herein. <br>

            <strong>Intellectual Property: </strong>All content, including text, images, logos, and graphics on this website, is the property of TAPA and is protected by intellectual property laws. Unauthorized use, reproduction, or distribution of any content is strictly prohibited without prior written consent. <br>

            <strong> Links to Third-Party Websites:</strong> This website may contain links to external websites for additional information. TAPA does not endorse or take responsibility for the content, accuracy, or security of these third-party websites. <br>

            <strong> Privacy Policy:</strong> Your privacy is important to us. Please refer to our Privacy Policy for information on how we collect, use, and protect your personal data. <br>

            <strong> Modification of Terms:</strong> TAPA reserves the right to modify or update these terms and conditions at any time without prior notice. Users are encouraged to review these terms periodically for any changes. <br>

            <strong>Governing Law: </strong>These terms and conditions shall be governed by and construed in accordance with the laws of Tanzania. Any disputes arising from the use of this website shall be subject to the jurisdiction of Tanzanian courts. <br>


            By accessing and using the TAPA website, you agree to abide by these terms and conditions. If you do not agree with any part of these terms, please refrain from using this website. <br>

            For any inquiries or concerns regarding these terms and conditions, please contact us at <strong>info@tapa.or.tz</strong>
          </p>
          <!-- Include the terms and conditions content from the previous example -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php include "footer.php" ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>