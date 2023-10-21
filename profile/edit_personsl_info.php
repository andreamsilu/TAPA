<!-- Profile Edit Form -->
<form method="POST" action="forms/edit-personal-info-script.php">
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

  <div class="text-center">
    <button type="submit" class="btn btn-primary" name="editProfile">Save Changes</button>
  </div>
</form>