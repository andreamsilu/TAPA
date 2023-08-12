<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registration -TAPA</title>
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
<body >
<?php include "header.php"?>

  <main>
    <!-- ======= Breadcrumbs ======= -->
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


    <!-- Profile registration Form -->
    <!-- <div class="container-fluid"> -->
    <form class="m-5 w-70 align-center">
      <!-- <div class="row"> -->
        <!-- <div class="col-md-6"> -->
                    <div class="row">
                      <div class="col-md-6">

                      <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="">
                      </div>
                       </div>

                       <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Postal code</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="profilepic" class="col-md-4 col-lg-3 col-form-label">Upload profile Picture</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="profilepic" type="file" class="form-control" id="profilepic" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="birthdate" class="col-md-4 col-lg-3 col-form-label">Birth Date</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="birthdate" type="date" class="form-control" id="birthdate" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="regdate" class="col-md-4 col-lg-3 col-form-label">Registration Date</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="regdate" type="date" class="form-control" id="regdate" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About Yourself</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
                      </div>
                    </div>

                  </div>



                  <div class="col-md-6">

                   

                    <div class="row mb-3">
                      <label for="cv" class="col-md-4 col-lg-3 col-form-label">upload cv</label>
                      <div class="col-md-8 col-lg-9">
                        <!-- <textarea name="cv" class="form-control" id="cv" ></textarea> -->
                        <input type="file" name="cv" id="cv" class="form-control">
                      </div>
                    </div>
                  <!-- </div>
                  </div> -->

                    <div class="row mb-3">
                      <label for="education_level" class="col-md-4 col-lg-3 col-form-label">Education level</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="education_level" type="text" class="form-control" id="education_level" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="specialization" class="col-md-4 col-lg-3 col-form-label">Specialization</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="specialization" type="text" class="form-control" id="specialization" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="region" class="col-md-4 col-lg-3 col-form-label">Region</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="region" type="text" class="form-control" id="region" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="">
                      </div>
                    </div>

                    

                    

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="">
                      </div>
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn " style="background:#0F718A;"> <a href="login.php" class="text-white">Finish Registration</a> </button>
                    </div>

                  </div>
                
                  </form>
              </div>
                  <!-- End Profile registration Form -->


    </div>
    </div>
  </main>
  <!-- End #main -->
</body>
</html>

<?php include "footer.php"?>

