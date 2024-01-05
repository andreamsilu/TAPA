<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Set height of body and make it scrollable */
        body {
            height: 100%;
            overflow-y: auto;
        }

        /* Set padding to keep content from hitting the edges */
        .container-fluid {
            padding-left: 20px;
            padding-right: 20px;
            margin-top: 40px;
        }

        .sidebar {
            padding-top: 25px;
            height: 100vh;
            /* Set sidebar height to full viewport height */
            position: fixed;
            /* Fixes the sidebar position */
            top: 0;
            /* Aligns the sidebar to the top */
            left: 0;
            /* Aligns the sidebar to the left */
            overflow-y: auto;
            /* Allows vertical scrolling if content exceeds viewport height */
        }

        .progress {
            height: 5px;
        }

        .progress-bar {
            transition: width 0.3s ease-in-out;
        }



        .card-content {
            display: none;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Media query for mobile devices */
        @media (max-width: 767px) {
            .navbar {
                background-color: #f8f9fa;
                /* Background color for mobile navbar */
                border-bottom: 1px solid #ddd;
                /* Border at the bottom of mobile navbar */
            }

            .navbar-toggler {
                color: #333;
                /* Color of the mobile toggle icon */
            }

            .navbar-nav .nav-item {
                margin-bottom: 10px;
                /* Space between mobile nav items */
            }

            .navbar-nav .nav-link {
                color: #333;
                /* Nav link color */
                /* Additional styles for mobile nav links */
            }
        }
    </style>
</head>

<body>
    <?php
    // include("header.php");
    include("titleIcon.php");


    ?>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #;">
        <a class="navbar-brand" href="#">Your Logo</a>

        <!-- Toggler/collapsible Button for small screens -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">updateProgressBar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">membership fees</a>
                </li>
                <!-- Other Links -->
            </ul>

            <!-- Profile Avatar with Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> <!-- Default avatar icon from Font Awesome -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>




    <div class="container-fluid">
        <div class="row">

            <!-- Collapsible menu for smaller screens -->
            <nav class="col-12 d-lg-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <!-- Side navigation for large screens -->
            <nav class="col-lg-2 bg-light sidebar d-none d-lg-block">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="navbar-brand" href="index.php"><img src="assets/img/tapa.png" width="100px"></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content1')">
                                <i class="fas fa-user mr-2"></i>Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content2')">
                                <i class="fas fa-address-card mr-2"></i>Contact Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content3')">
                                <i class="fas fa-graduation-cap mr-2"></i>Education
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content4')">
                                <i class="fas fa-certificate mr-2"></i>Training and Certificates
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content5')">
                                <i class="fas fa-briefcase mr-2"></i>Employment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content6')">
                                <i class="fas fa-file-alt mr-2"></i>Cv
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCardContent('content7')">
                                <i class="fas fa-key mr-2"></i>Change password
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="<? logout() ?>">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <?php
            session_start();

            function logout()
            {
                // Unset all session variables
                $_SESSION = [];

                // Destroy the session
                session_destroy();

                // Redirect to a login page or any other page after logout
                header("Location: login.php");
                exit();
            }
            ?>

            <!-- Collapsible menu for smaller screens -->
            <nav class="col-12 d-lg-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <!-- <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                <div class="card-content" id="content1">
                    <!-- Card content for Link 1 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-user mr-2"></i>Personal Information</h4>
                            </div>
                            <button class="btn btn-primary" onclick="displayModal()"><i class="fas fa-plus"></i>Add</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 1</h5>
                            <p class="card-text">This is the card content for Link 1 displayed when Link 1 is clicked.</p>
                            <button class="btn btn-secondary" onclick="displayEditPersonalInfoModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="personalInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add Personal Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for personal information goes here -->
                                <!-- Example: -->
                                <form id="personalInfoForm" action="../forms/edit-personal-info-script.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nationality">Nationality</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthDate">Date of Birth</label>
                                                <input type="date" class="form-control" id="birthDate" name="birthDate">
                                            </div>
                                            <div class="form-group">
                                                <label for="countryResidence">Country of Residence</label>
                                                <input type="text" class="form-control" id="countryResidence" name="countryResidence" placeholder="Country of Residence">
                                            </div>
                                            <div class="form-group">
                                                <label for="cityResidence">City/Town of Residence</label>
                                                <input type="text" class="form-control" id="cityResidence" name="cityResidence" placeholder="City/Town of Residence">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="practitionerLicense">Practitioner License</label>
                                                <input type="text" class="form-control" id="practitionerLicense" name="practitionerLicense" placeholder="Practitioner License">
                                            </div>
                                            <div class="form-group">
                                                <label for="languages">Languages</label>
                                                <input type="text" class="form-control" id="languages" name="languages" placeholder="Languages">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closePersonalInfoForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="editPersonalInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Personal Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditPersonalInfoModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for editing personal information -->
                                <form id="personalInfoForm" action="../forms/edit-personal-info-script.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nationality">Nationality</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthDate">Date of Birth</label>
                                                <input type="date" class="form-control" id="birthDate" name="birthDate">
                                            </div>
                                            <div class="form-group">
                                                <label for="countryResidence">Country of Residence</label>
                                                <input type="text" class="form-control" id="countryResidence" name="countryResidence" placeholder="Country of Residence">
                                            </div>
                                            <div class="form-group">
                                                <label for="cityResidence">City/Town of Residence</label>
                                                <input type="text" class="form-control" id="cityResidence" name="cityResidence" placeholder="City/Town of Residence">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="practitionerLicense">Practitioner License</label>
                                                <input type="text" class="form-control" id="practitionerLicense" name="practitionerLicense" placeholder="Practitioner License">
                                            </div>
                                            <div class="form-group">
                                                <label for="languages">Languages</label>
                                                <input type="text" class="form-control" id="languages" name="languages" placeholder="Languages">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closePersonalInfoForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-content" id="content2">
                    <!-- Card content for Link 2 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-address-card mr-2"></i>Contact Information</h4>
                            </div>
                            <button class="btn btn-primary" onclick="displayContactModal()"><i class="fas fa-plus"></i>Add</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 2</h5>
                            <p class="card-text">This is the card content for Link 2 displayed when Link 2 is clicked.</p>
                            <button class="btn btn-secondary" onclick="displayEditContactInfoModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="contactInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add Contact Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeContactModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for contact information goes here -->
                                <!-- Example: -->
                                <form id="contactInfoForm" action="../forms/edit-contact-info-script.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile1">Mobile 1</label>
                                                <input type="tel" class="form-control" id="mobile1" name="mobile1" placeholder="+255754289824">
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile2">Mobile 2</label>
                                                <input type="tel" class="form-control" id="mobile2" name="mobile2" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="whatsappNumber">Whatsapp Number</label>
                                                <input type="tel" class="form-control" id="whatsappNumber" name="whatsappNumber" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="secondaryEmail">Secondary Email</label>
                                                <input type="email" class="form-control" id="secondaryEmail" name="secondaryEmail" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="workEmail">Work Email</label>
                                                <input type="email" class="form-control" id="workEmail" name="workEmail" placeholder="-">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="countryResidence">Country of Residence</label>
                                                <input type="text" class="form-control" id="countryResidence" name="countryResidence" placeholder="Tanzania">
                                            </div>
                                            <div class="form-group">
                                                <label for="stateResidence">State of Residence</label>
                                                <input type="text" class="form-control" id="stateResidence" name="stateResidence" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="cityResidence">City of Residence</label>
                                                <input type="text" class="form-control" id="cityResidence" name="cityResidence" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="areaResidence">Area of Residence</label>
                                                <input type="text" class="form-control" id="areaResidence" name="areaResidence" placeholder="-">
                                            </div>
                                            <div class="form-group">
                                                <label for="zipCode">ZIP Code / PO Box</label>
                                                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeContactInfoForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="editContactInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Contact Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditContactInfoModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for editing contact information -->
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number:</label>
                                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber">
                                    </div>
                                    <!-- Add more fields as needed -->
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-content" id="content3">
                    <!-- Card content for Link 3 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-graduation-cap mr-2"></i>Education Information</h4>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="displayEducationModal()"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 3</h5>
                            <p class="card-text">This is the card content for Link 3 displayed when Link 3 is clicked.</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary" onclick="displayEditEducationInfoModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="educationInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add Education Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEducationModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for education information goes here -->
                                <!-- Example: -->
                                <form id="educationForm" action="../forms/education-script.php">
                                    <div class="form-group">
                                        <label for="award">Award</label>
                                        <input type="text" class="form-control" id="award" name="award" placeholder="Bachelor,Diploma,Certificate">
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Institution</label>
                                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Institution">
                                    </div>
                                    <div class="form-group">
                                        <label for="yearOfGraduation">Year of Graduation</label>
                                        <input type="date" class="form-control" id="yearOfGraduation" name="yearOfGraduation" placeholder="Year of Graduation">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEducationForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="editEducationInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Education Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditEducationInfoModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for editing education information -->
                                <form id="educationForm" action="../forms/education-script.php">
                                    <div class="form-group">
                                        <label for="award">Award</label>
                                        <input type="text" class="form-control" id="award" name="award" placeholder="Bachelor,Diploma,Certificate">
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Institution</label>
                                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Institution">
                                    </div>
                                    <div class="form-group">
                                        <label for="yearOfGraduation">Year of Graduation</label>
                                        <input type="date" class="form-control" id="yearOfGraduation" name="yearOfGraduation" placeholder="Year of Graduation">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEducationForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-content" id="content4">
                    <!-- Card content for Link 4 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-certificate mr-2"></i>Certificates Information</h4>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="displayCertificatesModal()"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 4</h5>
                            <p class="card-text">This is the card content for Link 4 displayed when Link 4 is clicked.</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary" onclick="displayEditCertificatesModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="certificatesInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add Certificates Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeCertificatesModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for certificates information goes here -->
                                <!-- Example: -->
                                <form>
                                    <div class="form-group">
                                        <label for="certificate">Certificate:</label>
                                        <input type="text" class="form-control" id="certificate" placeholder="Enter Certificate">
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Institution:</label>
                                        <input type="text" class="form-control" id="institution" placeholder="Enter Institution">
                                    </div>
                                    <div class="form-group">
                                        <label for="certification_date">Date/Year of Certification:</label>
                                        <input type="text" class="form-control" id="certification_date" placeholder="Enter Date/Year">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal" id="editCertificatesModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Certificates Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditCertificatesModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for editing certificates information -->
                                <form>
                                    <div class="form-group">
                                        <label for="certificate">Certificate:</label>
                                        <input type="text" class="form-control" id="certificate" placeholder="Enter Certificate">
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Institution:</label>
                                        <input type="text" class="form-control" id="institution" placeholder="Enter Institution">
                                    </div>
                                    <div class="form-group">
                                        <label for="certification_date">Date/Year of Certification:</label>
                                        <input type="text" class="form-control" id="certification_date" placeholder="Enter Date/Year">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-content" id="content5">
                    <!-- Card content for Link 5 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-briefcase mr-2"></i>Experience Information</h4>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="displayExperienceModal()"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 5</h5>
                            <p class="card-text">This is the card content for Link 5 displayed when Link 5 is clicked.</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary" onclick="displayEditEmploymentModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="experienceInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Employment Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeExperienceModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for experience information goes here -->
                                <!-- Example: -->
                                <form id="employmentForm" action="../forms/employment-script.php">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Position">
                                    </div>
                                    <div class="form-group">
                                        <label for="institution">Institution</label>
                                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Institution">
                                    </div>
                                    <div class="form-group">
                                        <label for="startingDate">Starting Date</label>
                                        <input type="date" class="form-control" id="startingDate" name="startingDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="employmentType">Employment Type</label>
                                        <select class="form-control" id="employmentType" name="employmentType">
                                            <option value="" disabled selected>Select Employment Type</option>
                                            <option value="fullTime">Full-Time</option>
                                            <option value="partTime">Part-Time</option>
                                            <option value="contract">Contract</option>
                                            <option value="freelance">Freelance</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEmploymentForm()">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="editEmploymentModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Employment Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditEmploymentModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for editing employment information -->
                                <form>
                                    <div class="form-group">
                                        <label for="companyName">Company Name:</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName">
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="text" class="form-control" id="position" name="position">
                                    </div>
                                    <!-- Add more fields as needed -->
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-content" id="content6">
                    <!-- Card content for Link 2 -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4><i class="fas fa-file-alt mr-2"></i>Cv & Documentation</h4>
                            </div>
                            <div>
                                <button class="btn btn-primary" onclick="displayDocumentationModal()"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 2</h5>
                            <p class="card-text">This is the card content for Link 2 displayed when Link 2 is clicked.</p>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary" onclick="displayEditCVModal()"><i class="fas fa-pencil-alt"></i>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="documentationInfoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add CV & Documentation Information</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeDocumentationModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Your form for CV & documentation information goes here -->
                                <form>
                                    <div class="form-group">
                                        <label for="cv">Upload CV:</label>
                                        <input type="file" class="form-control-file" id="cv" name="cv">
                                    </div>
                                    <div class="form-group">
                                        <label for="documentation">Upload Documentation:</label>
                                        <input type="file" class="form-control-file" id="documentation" name="documentation">
                                    </div>
                                    <!-- Add more fields as needed -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal" id="editCVModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Edit CV & Documentation</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeEditCVModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for uploading or editing CV -->
                                <form>
                                    <div class="form-group">
                                        <label for="cvUpload">Upload CV:</label>
                                        <input type="file" class="form-control-file" id="cvUpload" name="cvUpload">
                                    </div>
                                    <!-- Add more fields or options for editing CV if needed -->
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-content" id="content7">
                    <!-- Card content for changing password -->
                    <div class="card text-center">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><i class="fas fa-key mr-2"></i>Change Password</h4>
                            <button class="btn btn-primary" onclick="displayChangePasswordModal()">Change</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Content for Link 2</h5>
                            <p class="card-text">This is the card content for changing password.</p>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="changePasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeChangePasswordModal()">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- Form for changing password -->
                                <form>
                                    <div class="form-group">
                                        <label for="oldPassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                                    </div>
                                    <!-- Add more fields as needed -->
                                    <button type="submit" class="btn btn-primary">Save new password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>





            </main>


        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showCardContent(contentId) {
            // Hide all card-content Cardelements
            var cardContents = document.querySelectorAll('.card-content');
            cardContents.forEach(function(content) {
                content.style.display = 'none';
            });

            // Show the selected card content
            var selectedCardContent = document.getElementById(contentId);
            if (selectedCardContent) {
                selectedCardContent.style.display = 'block';
            }
        }

        // Function to display the modal
        function displayModal() {
            $('#personalInfoModal').modal('show');
        }

        // Function to close the modal
        function closeModal() {
            $('#personalInfoModal').modal('hide');
        }


        // Function to display the contact info modal
        function displayContactModal() {
            $('#contactInfoModal').modal('show');
        }

        // Function to close the contact info modal
        function closeContactModal() {
            $('#contactInfoModal').modal('hide');
        }


        // Function to display the education info modal
        function displayEducationModal() {
            $('#educationInfoModal').modal('show');
        }

        // Function to close the education info modal
        function closeEducationModal() {
            $('#educationInfoModal').modal('hide');
        }

        // Function to display the certificates info modal
        function displayCertificatesModal() {
            $('#certificatesInfoModal').modal('show');
        }

        // Function to close the certificates info modal
        function closeCertificatesModal() {
            $('#certificatesInfoModal').modal('hide');
        }


        // Function to display the experience info modal
        function displayExperienceModal() {
            $('#experienceInfoModal').modal('show');
        }

        // Function to close the experience info modal
        function closeExperienceModal() {
            $('#experienceInfoModal').modal('hide');
        }

        // Function to display the documentation info modal
        function displayDocumentationModal() {
            $('#documentationInfoModal').modal('show');
        }

        // Function to close the documentation info modal
        function closeDocumentationModal() {
            $('#documentationInfoModal').modal('hide');
        }

        // Function to display the change password modal
        function displayChangePasswordModal() {
            $('#changePasswordModal').modal('show');
        }

        // Function to close the change password modal
        function closeChangePasswordModal() {
            $('#changePasswordModal').modal('hide');
        }

        // Function to display the edit personal info modal
        function displayEditPersonalInfoModal() {
            $('#editPersonalInfoModal').modal('show');
        }

        // Function to close the edit personal info modal
        function closeEditPersonalInfoModal() {
            $('#editPersonalInfoModal').modal('hide');
        }

        // Function to display the edit contact info modal
        function displayEditContactInfoModal() {
            $('#editContactInfoModal').modal('show');
        }

        // Function to close the edit contact info modal
        function closeEditContactInfoModal() {
            $('#editContactInfoModal').modal('hide');
        }

        // Function to display the edit education info modal
        function displayEditEducationInfoModal() {
            $('#editEducationInfoModal').modal('show');
        }

        // Function to close the edit education info modal
        function closeEditEducationInfoModal() {
            $('#editEducationInfoModal').modal('hide');
        }

        // Function to display the edit certificates modal
        function displayEditCertificatesModal() {
            $('#editCertificatesModal').modal('show');
        }

        // Function to close the edit certificates modal
        function closeEditCertificatesModal() {
            $('#editCertificatesModal').modal('hide');
        }

        // Function to display the edit employment modal
        function displayEditEmploymentModal() {
            $('#editEmploymentModal').modal('show');
        }

        // Function to close the edit employment modal
        function closeEditEmploymentModal() {
            $('#editEmploymentModal').modal('hide');
        }

        // Function to display the edit CV modal
        function displayEditCVModal() {
            $('#editCVModal').modal('show');
        }

        // Function to close the edit CV modal
        function closeEditCVModal() {
            $('#editCVModal').modal('hide');
        }

        // Initially, set the first link as active
        document.getElementById('navLink1').classList.add('active');

        // Function to calculate form completion and update the progress bar
        function updateProgressBar() {
            const totalSteps = 5; // Update this to the total number of steps or form sections
            const completedSteps = 3; // Update this to the number of completed steps

            const progress = (completedSteps / totalSteps) * 100;
            const progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }
    </script>
</body>

</html>