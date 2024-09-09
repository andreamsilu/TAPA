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

.error-message {
    color: red;
    font-size: 14px;
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
                                <form id="myForm" action="forms/register-script.php" method="post" role="form"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Full Name -->
                                            <div class="form-group">
                                                <label for="fullname"><i class="bi bi-person"></i> Full Name</label>
                                                <input type="text" name="fullname" class="form-control" id="fullname"
                                                    placeholder="Your full name" required>
                                                <small id="nameError" class="error-message"></small>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Your Email" required>
                                                <small id="emailError" class="error-message"></small>
                                            </div>

                                            <!-- Phone -->
                                            <div class="form-group">
                                                <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Your phone" required>
                                                <small id="phoneError" class="error-message"></small>
                                            </div>

                                            <!-- Postal Address -->
                                            <div class="form-group">
                                                <label for="postal_address"><i class="bi bi-house-door"></i> Postal
                                                    Address</label>
                                                <input type="text" class="form-control" name="postal_address"
                                                    id="postal_address" placeholder="Postal address" required>
                                                <small id="postalAddressError" class="error-message"></small>
                                            </div>

                                            <!-- Birth Date -->
                                            <div class="form-group">
                                                <label for="birth_date"><i class="bi bi-calendar"></i> Birth
                                                    date</label>
                                                <input type="text" class="form-control" name="birth_date"
                                                    id="birth_date" placeholder="Birthdate" required>
                                                <small id="birthDateError" class="error-message"></small>
                                            </div>

                                            <!-- Gender -->
                                            <div class="form-group">
                                                <label for="gender"><i class="bi bi-gender-ambiguous"></i>
                                                    Gender</label>
                                                <select name="gender" id="gender" class="form-control" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <small id="genderError" class="error-message"></small>
                                            </div>

                                            <!-- CV Upload -->
                                            <div class="form-group">
                                                <label for="cv"><i class="bi bi-file-earmark-pdf"></i> Upload your
                                                    CV</label>
                                                <input type="file" class="form-control" name="cv" id="cv"
                                                    placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                                                <small id="cvError" class="error-message"></small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Occupation -->
                                            <div class="form-group">
                                                <label for="occupation"><i class="bi bi-briefcase"></i>
                                                    Occupation</label>
                                                <input type="text" class="form-control" name="occupation"
                                                    id="occupation" placeholder="Occupation" required>
                                                <small id="occupationError" class="error-message"></small>
                                            </div>

                                            <!-- NIDA Number -->
                                            <div class="form-group">
                                                <label for="nida"><i class="bi bi-person-badge"></i> NIDA Number</label>
                                                <input type="text" class="form-control" name="nida" id="nida"
                                                    placeholder="NIDA Number" required>
                                                <small id="nidaError" class="error-message"></small>
                                            </div>

                                            <!-- Academic Qualification -->
                                            <div class="form-group">
                                                <label for="qualification"><i class="bi bi-book"></i> Academic
                                                    Qualification</label>
                                                <input type="text" class="form-control" name="qualification"
                                                    id="qualification" placeholder="Academic Qualification" required>
                                                <small id="qualificationError" class="error-message"></small>
                                            </div>

                                            <!-- Experience -->
                                            <div class="form-group">
                                                <label for="experience"><i class="bi bi-graph-up"></i> Work
                                                    Experience</label>
                                                <input type="text" class="form-control" name="experience"
                                                    id="experience" placeholder="Work Experience" required>
                                                <small id="experienceError" class="error-message"></small>
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label for="password"><i class="bi bi-lock"></i> Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Password" required>
                                                <small id="passwordError" class="error-message"></small>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="form-group">
                                                <label for="confirm_password"><i class="bi bi-lock-fill"></i> Confirm
                                                    Password</label>
                                                <input type="password" class="form-control" name="confirm_password"
                                                    id="confirm_password" placeholder="Confirm Password" required>
                                                <small id="confirmPasswordError" class="error-message"></small>
                                            </div>

                                            <!-- Terms and Conditions -->
                                            <div class="form-group">
                                                <button type="button" class="btn btn-secondary accordion btn-block"
                                                    data-toggle="modal" data-target="#termsModal">
                                                    <i class="bi bi-file-earmark-text"></i> Read the terms and
                                                    conditions
                                                </button>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="agree_terms"
                                                    required>
                                                <label class="form-check-label" for="agree_terms">I agree to the terms
                                                    and conditions</label>
                                                <small id="termsError" class="error-message"></small>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Terms and Conditions Modal -->
                                <div class="modal fade" id="termsModal" tabindex="-1" role="dialog"
                                    aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Include the terms and conditions here -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card Body -->
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Registration Section -->
    </main>

    <!-- Real-time validation script -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('myForm');

        // Full Name Validation
        const fullname = document.getElementById('fullname');
        const nameError = document.getElementById('nameError');
        fullname.addEventListener('input', function() {
            if (fullname.value.trim().length < 3) {
                nameError.textContent = "Full name must be at least 3 characters.";
            } else {
                nameError.textContent = "";
            }
        });

        // Email Validation
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        email.addEventListener('input', function() {
            if (!emailPattern.test(email.value)) {
                emailError.textContent = "Please enter a valid email address.";
            } else {
                emailError.textContent = "";
            }
        });

        // Phone Validation
        const phone = document.getElementById('phone');
        const phoneError = document.getElementById('phoneError');
        phone.addEventListener('input', function() {
            if (!/^\d{10}$/.test(phone.value)) {
                phoneError.textContent = "Phone number must be 10 digits.";
            } else {
                phoneError.textContent = "";
            }
        });

        // Postal Address Validation
        const postalAddress = document.getElementById('postal_address');
        const postalAddressError = document.getElementById('postalAddressError');
        postalAddress.addEventListener('input', function() {
            if (postalAddress.value.trim().length < 5) {
                postalAddressError.textContent = "Postal address must be at least 5 characters.";
            } else {
                postalAddressError.textContent = "";
            }
        });

        // Birth Date Validation
        const birthDate = document.getElementById('birth_date');
        const birthDateError = document.getElementById('birthDateError');
        birthDate.addEventListener('input', function() {
            if (!birthDate.value) {
                birthDateError.textContent = "Please select your birth date.";
            } else {
                birthDateError.textContent = "";
            }
        });

        // Gender Validation
        const gender = document.getElementById('gender');
        const genderError = document.getElementById('genderError');
        gender.addEventListener('change', function() {
            if (gender.value === "") {
                genderError.textContent = "Please select your gender.";
            } else {
                genderError.textContent = "";
            }
        });

        // CV Upload Validation
        const cv = document.getElementById('cv');
        const cvError = document.getElementById('cvError');
        const allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
        cv.addEventListener('change', function() {
            if (!allowedExtensions.exec(cv.value)) {
                cvError.textContent = "Please upload a valid CV file (.pdf, .doc, .docx).";
            } else {
                cvError.textContent = "";
            }
        });

        // Occupation Validation
        const occupation = document.getElementById('occupation');
        const occupationError = document.getElementById('occupationError');
        occupation.addEventListener('input', function() {
            if (occupation.value.trim().length < 2) {
                occupationError.textContent = "Occupation must be at least 2 characters.";
            } else {
                occupationError.textContent = "";
            }
        });

        // NIDA Validation
        const nida = document.getElementById('nida');
        const nidaError = document.getElementById('nidaError');
        nida.addEventListener('input', function() {
            if (!/^\d{20}$/.test(nida.value)) {
                nidaError.textContent = "NIDA number must be 20 digits.";
            } else {
                nidaError.textContent = "";
            }
        });

        // Academic Qualification Validation
        const qualification = document.getElementById('qualification');
        const qualificationError = document.getElementById('qualificationError');
        qualification.addEventListener('input', function() {
            if (qualification.value.trim().length < 3) {
                qualificationError.textContent =
                "Academic qualification must be at least 3 characters.";
            } else {
                qualificationError.textContent = "";
            }
        });

        // Experience Validation
        const experience = document.getElementById('experience');
        const experienceError = document.getElementById('experienceError');
        experience.addEventListener('input', function() {
            if (experience.value.trim().length < 2) {
                experienceError.textContent = "Experience must be at least 2 characters.";
            } else {
                experienceError.textContent = "";
            }
        });

        // Password Validation
        const password = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        password.addEventListener('input', function() {
            if (password.value.trim().length < 6) {
                passwordError.textContent = "Password must be at least 6 characters.";
            } else {
                passwordError.textContent = "";
            }
        });

        // Confirm Password Validation
        const confirmPassword = document.getElementById('confirm_password');
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        confirmPassword.addEventListener('input', function() {
            if (confirmPassword.value !== password.value) {
                confirmPasswordError.textContent = "Passwords do not match.";
            } else {
                confirmPasswordError.textContent = "";
            }
        });

        // Terms and Conditions Validation
        const agreeTerms = document.getElementById('agree_terms');
        const termsError = document.getElementById('termsError');
        agreeTerms.addEventListener('change', function() {
            if (!agreeTerms.checked) {
                termsError.textContent = "You must agree to the terms and conditions.";
            } else {
                termsError.textContent = "";
            }
        });
    });
    </script>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>