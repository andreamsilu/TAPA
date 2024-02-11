
<?php include('titleIcon.php'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center"><i class="bi bi-person"></i> Registration Form</h2>
                </div>
                <div class="card-body" id="page1">
                    <form action="javascript:void(0);" method="post" role="form" enctype="multipart/form-data" onsubmit="nextPage()">
                        <div class="row">
                            <!-- Page 1 Fields -->
                            <!-- Page 1 Fields -->
                            <div class="col-md-6 form-group">
                                <label for="fullname" class="col-form-label"><i class="bi bi-person"></i> Full Name</label>
                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Your full name" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email" class="col-form-label"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="phone" class="col-form-label"><i class="bi bi-telephone"></i> Phone</label>
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Your phone" required>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="postal_address" class="col-form-label"><i class="bi bi-house-door"></i> Postal Address</label>
                                <input type="text" class="form-control" name="postal_address" id="postal_address" placeholder="Postal address" required>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="birth_date" class="col-form-label"><i class="bi bi-calendar"></i> Birth date</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" required>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="physical_address" class="col-form-label"><i class="bi bi-house"></i> Physical Address</label>
                                <input type="text" class="form-control" name="physical_address" id="physical_address" placeholder="Physical address" required>
                            </div>

                            <!-- Fields go here -->
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-arrow-right"></i> Next</button>
                        </div>
                    </form>
                </div>
                <div class="card-body" id="page2" style="display: none;">
                    <form action="forms/register-script.php" method="post" role="form" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Page 2 Fields -->
                            <div class="col-md-6 form-group">
                                <label for="membership_type" class="col-form-label">Select Membership category</label>
                                <select class="form-control" id="membership_type" name="membership_type" required>
                                    <option value="" disabled selected>Select membership category</option>
                                    <option value="full_member">Full Member</option>
                                    <option value="associate_one">Associate Member I</option>
                                    <option value="associate_two">Associate Member II</option>
                                    <option value="student_member">Student Member</option>
                                    <option value="local_affiliate_member">Local Affiliate Member</option>
                                    <option value="foreign_affiliate_member">Foreign Affiliate Member</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
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
                                <input type="text" name="yes_licensure" class="form-control" id="yes_licensure" placeholder="Your licensure">
                            </div>

                            <div class="col-md-6 form-group">
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

                            <div class="col-md-6 form-group">
                                <label for="yes_crime" class="col-form-label"><i class="bi bi-exclamation-triangle"></i> If Yes, please explain below</label>
                                <textarea class="form-control" name="yes_crime" rows="3" placeholder="Explain your crime situation"></textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="cv" class="col-form-label"><i class="bi bi-file-earmark-pdf"></i> Upload your CV</label>
                                <input type="file" class="form-control" name="cv" id="cv" placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                                <small class="text-muted">Accepted file formats: PDF, DOC, DOCX</small>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="password" class="col-form-label"><i class="bi bi-lock"></i> Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required minlength="8">
                                <small class="text-muted">Minimum length: 8 characters</small>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="confirm-password" class="col-form-label"><i class="bi bi-lock"></i> Confirm password</label>
                                <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password" required minlength="8">
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" onclick="prevPage()"><i class="bi bi-arrow-left"></i> Previous</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus"></i> Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function nextPage() {
        document.getElementById('page1').style.display = 'none';
        document.getElementById('page2').style.display = 'block';
    }

    function prevPage() {
        document.getElementById('page1').style.display = 'block';
        document.getElementById('page2').style.display = 'none';
    }
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1