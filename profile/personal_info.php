<div class="card">
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <h2 class="text-center mb-4">Personal Information</h2>
        <div class="profile-image">
            <img src="https://via.placeholder.com/120" alt="Default Avatar" class="rounded-circle img-thumbnail">
        </div>
        <div class="profile-details mt-4">
            <h2 class="text-center"><?php echo $firstname . " " . $lastname ?></h2>
            <div class="profile-info">
                <h3><span class="font-weight-bold">Full Name:</span> <?php echo $firstname . " " . $lastname ?></h3>
                <h3><span class="font-weight-bold">Email:</span> <?php echo $email ?></h3>
                <h3><span class="font-weight-bold">Phone:</span> <?php echo $phone ?></h3>
                <h3><span class="font-weight-bold">Address:</span> <?php echo $address ?></h3>
            </div>
            <!-- Edit button below profile details -->
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-danger">Sign Out</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your edit profile form goes here -->
                <form>
                    <!-- Form fields for editing profile information -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
