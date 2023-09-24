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

    <!-- Profile registration Form -->
    <form action="forms/register.php" method="POST" class="m-5 w-70 align-center" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <label for="fullName" class="col-form-label">Full Name</label>
          <input name="fullName" type="text" class="form-control" id="fullName" value="">

          <label for="Email" class="col-form-label">Email</label>
          <input name="email" type="email" class="form-control" id="Email" value="">

          <label for="Phone" class="col-form-label">Phone</label>
          <input name="phone" type="text" class="form-control" id="Phone" value="">

          <label for="password" class="col-form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" value="">

          <label for="profilepic" class="col-form-label">Upload Profile Picture</label>
          <input name="profilepic" type="file" class="form-control" id="profilepic">

          <label for="region" class="col-form-label">Region</label>
          <input name="region" type="text" class="form-control" id="region" value="">

          <label for="address" class="col-form-label">Address</label>
          <input name="address" type="text" class="form-control" id="address" value="">

          <label for="about" class="col-form-label">About Yourself</label>
          <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
        </div>

        <div class="col-md-6">
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
          </div>
        </div>
      </div>
    </form>
    <!-- End Profile registration Form -->
  </main>

  <?php include "footer.php" ?>
</body>
</html>
