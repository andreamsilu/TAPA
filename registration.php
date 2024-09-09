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
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LfB6aEpAAAAAAqhOtkcweZgJDsXn3kV-FabTfep">
    </script>

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

    .text-danger {
        color: red;
    }
    </style>
</head>

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
                                            <div class="form-group">
                                                <label for="fullname"><i class="bi bi-person"></i> Full Name</label>
                                                <input type="text" name="fullname" class="form-control" id="fullname"
                                                    placeholder="Your full name" required>
                                                <small id="nameError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Your Email" required>
                                                <small id="emailError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Your phone" required>
                                                <small id="phoneError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="postal_address"><i class="bi bi-house-door"></i> Postal
                                                    Address</label>
                                                <input type="text" class="form-control" name="postal_address"
                                                    id="postal_address" placeholder="Postal address" required>
                                                <small id="postalAddressError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="birth_date"><i class="bi bi-calendar"></i> Birth
                                                    date</label>
                                                <input type="text" class="form-control" name="birth_date"
                                                    id="birth_date" placeholder="Birthdate" required>
                                                <small id="birthDateError" class="text-danger"></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="cv"><i class="bi bi-file-earmark-pdf"></i> Upload your
                                                    CV</label>
                                                <input type="file" class="form-control" name="cv" id="cv"
                                                    placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                                                <small class="text-muted">Accepted file formats: PDF, DOC, DOCX</small>
                                                <small id="cvError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="physical_address"><i class="bi bi-house"></i> Physical
                                                    Address</label>
                                                <input type="text" class="form-control" name="physical_address"
                                                    id="physical_address" placeholder="Physical address" required>
                                                <small id="physicalAddressError" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="membership_type">Select Membership category</label>
                                                <select class="form-control" id="membership_type" name="membership_type"
                                                    required>
                                                    <option value="" disabled selected>Select membership category
                                                    </option>
                                                    <option value="full_member">Full Member</option>
                                                    <option value="associate_one">Associate Member I</option>
                                                    <option value="associate_two">Associate Member II</option>
                                                    <option value="student">Student Member</option>
                                                    <option value="local_affiliate">Local Affiliate Member</option>
                                                    <option value="foreign_affiliate">Foreign Affiliate Member</option>
                                                </select>
                                                <small id="membershipTypeError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="licensure">Licensure/Ethics</label>
                                                <div>
                                                    <input type="radio" name="licensure" value="yes" id="licensure_yes"
                                                        required>
                                                    <label for="licensure_yes">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="licensure" value="no" id="licensure_no"
                                                        required>
                                                    <label for="licensure_no">No</label>
                                                </div>
                                                <small id="licensureError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="yes_licensure"><i class="bi bi-check2"></i> If Yes, Mention
                                                    below</label>
                                                <input type="text" name="yes_licensure" class="form-control"
                                                    id="yes_licensure" placeholder="Your licensure">
                                                <small id="yesLicensureError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="crimes">Crimes</label>
                                                <div>
                                                    <input type="radio" name="crime" value="yes" id="crime_yes"
                                                        required>
                                                    <label for="crime_yes">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="crime" value="no" id="crime_no" required>
                                                    <label for="crime_no">No</label>
                                                </div>
                                                <small id="crimeError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="yes_crime"><i class="bi bi-exclamation-triangle"></i> If
                                                    Yes, please explain below</label>
                                                <textarea class="form-control" name="yes_crime" id="yes_crime"
                                                    placeholder="Details about crime"></textarea>
                                                <small id="yesCrimeError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="termsCheck"><i class="bi bi-check-circle"></i> Agree to
                                                    Terms and Conditions</label>
                                                <input type="checkbox" name="termsCheck" id="termsCheck" required>
                                                <small id="termsError" class="text-danger"></small>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Register</button>
                                            </div>
                                        </div>
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
    <!-- End #main -->

    <!-- Bootstrap JS and Flatpickr JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Custom JavaScript for validation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('myForm');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('email');
        const fullnameInput = document.getElementById('fullname');
        const postalAddressInput = document.getElementById('postal_address');
        const birthDateInput = document.getElementById('birth_date');
        const physicalAddressInput = document.getElementById('physical_address');
        const cvInput = document.getElementById('cv');
        const membershipTypeSelect = document.getElementById('membership_type');
        const licensureRadios = document.getElementsByName('licensure');
        const crimeRadios = document.getElementsByName('crime');
        const termsCheck = document.getElementById('termsCheck');

        // Initialize Flatpickr for date input
        flatpickr(birthDateInput, {
            dateFormat: 'Y-m-d',
        });

        // Full Name Validation
        fullnameInput.addEventListener('input', function() {
            const nameError = document.getElementById('nameError');
            if (fullnameInput.value.trim() === '') {
                nameError.textContent = 'Full Name is required.';
            } else {
                nameError.textContent = '';
            }
        });

        // Email Validation
        emailInput.addEventListener('input', function() {
            const emailError = document.getElementById('emailError');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                emailError.textContent = 'Invalid email address.';
            } else {
                emailError.textContent = '';
            }
        });

        // Phone Validation
        phoneInput.addEventListener('input', function() {
            const phoneError = document.getElementById('phoneError');
            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phoneInput.value.trim())) {
                phoneError.textContent = 'Phone number must be 10 digits.';
            } else {
                phoneError.textContent = '';
            }
        });

        // Postal Address Validation
        postalAddressInput.addEventListener('input', function() {
            const postalAddressError = document.getElementById('postalAddressError');
            if (postalAddressInput.value.trim() === '') {
                postalAddressError.textContent = 'Postal Address is required.';
            } else {
                postalAddressError.textContent = '';
            }
        });

        // Birth Date Validation
        birthDateInput.addEventListener('input', function() {
            const birthDateError = document.getElementById('birthDateError');
            if (birthDateInput.value.trim() === '') {
                birthDateError.textContent = 'Birth Date is required.';
            } else {
                birthDateError.textContent = '';
            }
        });

        // Physical Address Validation
        physicalAddressInput.addEventListener('input', function() {
            const physicalAddressError = document.getElementById('physicalAddressError');
            if (physicalAddressInput.value.trim() === '') {
                physicalAddressError.textContent = 'Physical Address is required.';
            } else {
                physicalAddressError.textContent = '';
            }
        });

        // CV Validation
        cvInput.addEventListener('change', function() {
            const cvError = document.getElementById('cvError');
            const file = cvInput.files[0];
            const allowedExtensions = ['pdf', 'doc', 'docx'];
            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    cvError.textContent = 'Invalid file type. Only PDF, DOC, and DOCX are allowed.';
                } else {
                    cvError.textContent = '';
                }
            } else {
                cvError.textContent = 'CV is required.';
            }
        });

        // Membership Type Validation
        membershipTypeSelect.addEventListener('change', function() {
            const membershipTypeError = document.getElementById('membershipTypeError');
            if (membershipTypeSelect.value === '') {
                membershipTypeError.textContent = 'Membership Type is required.';
            } else {
                membershipTypeError.textContent = '';
            }
        });

        // Licensure Validation
        Array.from(licensureRadios).forEach(radio => {
            radio.addEventListener('change', function() {
                const licensureError = document.getElementById('licensureError');
                if (radio.checked) {
                    licensureError.textContent = '';
                }
            });
        });

        // Crime Validation
        Array.from(crimeRadios).forEach(radio => {
            radio.addEventListener('change', function() {
                const crimeError = document.getElementById('crimeError');
                if (radio.checked) {
                    crimeError.textContent = '';
                }
            });
        });

        // Terms and Conditions Validation
        termsCheck.addEventListener('change', function() {
            const termsError = document.getElementById('termsError');
            if (!termsCheck.checked) {
                termsError.textContent = 'You must agree to the terms and conditions.';
            } else {
                termsError.textContent = '';
            }
        });

        // Form Submission
        form.addEventListener('submit', function(event) {
            let isValid = true;

            // Validate Full Name
            if (fullnameInput.value.trim() === '') {
                document.getElementById('nameError').textContent = 'Full Name is required.';
                isValid = false;
            }

            // Validate Email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                document.getElementById('emailError').textContent = 'Invalid email address.';
                isValid = false;
            }

            // Validate Phone Number
            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phoneInput.value.trim())) {
                document.getElementById('phoneError').textContent = 'Phone number must be 10 digits.';
                isValid = false;
            }

            // Validate Postal Address
            if (postalAddressInput.value.trim() === '') {
                document.getElementById('postalAddressError').textContent =
                    'Postal Address is required.';
                isValid = false;
            }

            // Validate Birth Date
            if (birthDateInput.value.trim() === '') {
                document.getElementById('birthDateError').textContent = 'Birth Date is required.';
                isValid = false;
            }

            // Validate Physical Address
            if (physicalAddressInput.value.trim() === '') {
                document.getElementById('physicalAddressError').textContent =
                    'Physical Address is required.';
                isValid = false;
            }

            // Validate CV
            if (cvInput.files.length === 0) {
                document.getElementById('cvError').textContent = 'CV is required.';
                isValid = false;
            }

            // Validate Membership Type
            if (membershipTypeSelect.value === '') {
                document.getElementById('membershipTypeError').textContent =
                    'Membership Type is required.';
                isValid = false;
            }

            // Validate Licensure
            const licensureChecked = Array.from(licensureRadios).some(radio => radio.checked);
            if (!licensureChecked) {
                document.getElementById('licensureError').textContent = 'Licensure status is required.';
                isValid = false;
            }

            // Validate Crime
            const crimeChecked = Array.from(crimeRadios).some(radio => radio.checked);
            if (!crimeChecked) {
                document.getElementById('crimeError').textContent = 'Crime status is required.';
                isValid = false;
            }

            // Validate Terms and Conditions
            if (!termsCheck.checked) {
                document.getElementById('termsError').textContent =
                    'You must agree to the terms and conditions.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission
            }
        });
    });
    </script>
</body>

</html>