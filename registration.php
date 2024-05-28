<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Favicons -->
  <link href="assets/img/tapa.png" rel="icon">
  <link href="assets/img/tapa.png" rel="apple-touch-icon">

  <!-- Bootstrap CSS and Flatpickr CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Google reCAPTCHA -->
  <script src="https://www.google.com/recaptcha/enterprise.js?render=6LfB6aEpAAAAAAqhOtkcweZgJDsXn3kV-FabTfep"></script>
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
    border: #0c5b6d solid 2px;
  }

  .registration .form-group {
    margin-bottom: 20px;
  }

  .registration a {
    color: #0F718A;
  }

  .registration a:hover {
    text-decoration: underline;
    color: #0c5b6d;
  }
</style>

<body>
  <?php include "titleIcon.php"; ?>
  <?php include "header.php"; ?>

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

    <!-- Registration Section -->
    <section id="registration" class="registration">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="text-center"><i class="bi bi-person"></i> Membership Registration Form</h2>
              </div>
              <div class="card-body">
                <form id="myForm" action="forms/register-script.php" method="post" role="form" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fullname"><i class="bi bi-person"></i> Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Your full name" required>
                        <small id="nameError" class="text-danger"></small>
                      </div>
                      <div class="form-group">
                        <label for="email"><i class="bi bi-envelope"></i> Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                      </div>
                      <div class="form-group">
                        <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone" required>
                      </div>
                      <div class="form-group">
                        <label for="postal_address"><i class="bi bi-house-door"></i> Postal Address</label>
                        <input type="text" class="form-control" name="postal_address" id="postal_address" placeholder="Postal address" required>
                      </div>
                      <div class="form-group">
                        <label for="birth_date"><i class="bi bi-calendar"></i> Birth date</label>
                        <input type="text" class="form-control" name="birth_date" id="birth_date" placeholder="Birthdate" required>
                      </div>

                      <div class="form-group">
                        <label for="cv"><i class="bi bi-file-earmark-pdf"></i> Upload your CV</label>
                        <input type="file" class="form-control" name="cv" id="cv" placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                        <small class="text-muted">Accepted file formats: PDF, DOC, DOCX</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="physical_address"><i class="bi bi-house"></i> Physical Address</label>
                        <input type="text" class="form-control" name="physical_address" id="physical_address" placeholder="Physical address" required>
                      </div>
                      <div class="form-group">
                        <label for="membership_type">Select Membership category</label>
                        <select class="form-control" id="membership_type" name="membership_type" required>
                          <option value="" disabled selected>Select membership category</option>
                          <option value="full_member">Full Member</option>
                          <option value="associate_one">Associate Member I</option>
                          <option value="associate_two">Associate Member II</option>
                          <option value="student">Student Member</option>
                          <option value="local_affiliate">Local Affiliate Member</option>
                          <option value="foreign_affiliate">Foreign Affiliate Member</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="licensure">Licensure/Ethics</label>
                        <div>
                          <input type="radio" name="licensure" value="yes" id="licensure_yes" required>
                          <label for="licensure_yes">Yes</label>
                        </div>
                        <div>
                          <input type="radio" name="licensure" value="no" id="licensure_no" required>
                          <label for="licensure_no">No</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="yes_licensure"><i class="bi bi-check2"></i> If Yes, Mention below</label>
                        <input type="text" name="yes_licensure" class="form-control" id="yes_licensure" placeholder="Your licensure">
                      </div>
                      <div class="form-group">
                        <label for="crimes">Crimes</label>
                        <div>
                          <input type="radio" name="crime" value="yes" id="crime_yes" required>
                          <label for="crime_yes">Yes</label>
                        </div>
                        <div>
                          <input type="radio" name="crime" value="no" id="crime_no" required>
                          <label for="crime_no">No</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="yes_crime"><i class="bi bi-exclamation-triangle"></i> If Yes, please explain below</label>
                        <textarea class="form-control" name="yes_crime" rows="3" placeholder="Explain your crime situation"></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="cv"><i class="bi bi-file-earmark-pdf"></i> Upload your CV</label>
                    <input type="file" class="form-control" name="cv" id="cv" placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                    <small class="text-muted">Accepted file formats: PDF, DOC, DOCX</small>
                  </div> -->
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary accordion btn-block" data-toggle="modal" data-target="#termsModal">
                      <i class="bi bi-file-earmark-text"></i> Read the terms and conditions
                    </button>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheck" name="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">I agree to the terms and conditions</label>
                  </div>
                  <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primar">Register</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Registration Section -->
  </main>

  <?php include "footer.php"; ?>

  <!-- Bootstrap and Flatpickr JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#birth_date", {
      dateFormat: "Y-m-d"
    });

    grecaptcha.ready(function() {
      grecaptcha.execute('6LfB6aEpAAAAAAqhOtkcweZgJDsXn3kV-FabTfep', {
        action: 'submit'
      }).then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
      });
    });
  </script>
</body>

</html>