<?php include("forms/myprofile.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add your CSS and JavaScript libraries here -->
</head>

<body>
    <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <h2 class="text-center mb-4">Personal Information</h2>
            <div class="profile-image">
                <!-- <img src="https://via.placeholder.com/120" alt="Default Avatar" class="rounded-circle img-thumbnail"> -->
                <img src="forms/uploads/<?php echo $profile_pic ?>" alt="Default Avatar" class="rounded-circle img-thumbnail">
            </div>
            <div class="profile-details mt-4">
                <h2 class="text-center"><?php echo $firstname . " " . $lastname ?></h2>
                <div class="profile-info">
                    <h3><span class="font-weight-bold">First Name:</span> <?php echo $firstname . " " . $lastname ?></h3>
                    <h3><span class="font-weight-bold">Email:</span> <?php echo $email ?></h3>
                    <h3><span class="font-weight-bold">Phone:</span> <?php echo $phone ?></h3>
                    <h3><span class="font-weight-bold">Address:</span> <?php echo $address ?></h3>
                    <h3><span class="font-weight-bold">Membership category:</span> <?php echo $membership_type ?></h3>

                </div>
                <!-- Edit button below profile details -->
                <div class="d-flex justify-content-between mt-3">
                    <button onclick="showEditInformationForm()" type="button" class="btn btn-primary">
                        Edit <i class="  fa-solid fa-pen-to-square"></i></button>
                    <button onclick="signOut()" type="button" class="btn btn-danger">
                        Sign Out<i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Personal Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeEditInformationForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your edit profile form goes here -->

                    <!-- Add this form below the displayed information -->
                    <form id="editProfileForm">
                        <div class="row">
                            <div class="  -group">
                                <label for="profilepic">Profile picture:</label>
                                <input type="file" class="form-control" id="profilepic" name="profilepic" placeholder="upload profile pic" value="forms/uploads/<?php echo $profile_pic  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6 form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value=" <?php echo $firstname  ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="<?php echo  $lastname ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $email ?>">
                            </div>
                            <div class="col-md-6 form form-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="<?php echo $phone ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $address ?>">
                            </div>
                            <div class="col-md-6 alertform-group">
                                <label for="membership_type" class="col-form-label">Select Membership category</label>
                                <select class="form-control" id="membership_type" name="membership_type" required>
                                    <option value="" disabled selected>Select membership category</option>
                                    <option value="student">Student Member</option>
                                    <option value="assiciate">Associate Mamber</option>
                                    <option value="affiliate">Affiliate Member</option>
                                    <option value="foreignAffiliate">Foreign Affiliate Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about" class="col-form-label">Tell about yourself</label>
                            <textarea class="form-control" name="about" rows="2" placeholder="about" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditInformationForm()">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show the edit profile modal
        function showEditInformationForm() {
            var editProfileModal = document.getElementById("editProfileModal");
            editProfileModal.style.display = "block";
        }

        // Function to close the edit profile modal
        function closeEditInformationForm() {
            var editProfileModal = document.getElementById("editProfileModal");
            editProfileModal.style.display = "none";
        }
    </script>
</body>

</html>