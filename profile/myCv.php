<?php 
// include("education/education_details.php") ;

?>
<div class="tab-pane fade show active" id="cv" role="tabpanel" aria-labelledby="cv-tab">
    <div class="container">
        <h2 class="mt-4">Curriculum Vitae (CV)</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Personal Information</h3>
                <p>Name: <?php echo $firstname . " " . $lastname ?></p>
                <p>Email: <?php echo $email ?></p>
                <p>Phone: <?php echo $phone ?></p>
                <p>Address: <?php echo $address ?></p>
            </div>
            <div class="col-md-6">
                <img src="forms/uploads/<?php echo $profile_pic ?>" alt="Default Avatar" class="rounded-circle img-thumbnail">
            </div>
        </div>
        <hr>
        <h3>Education</h3>
        <p>Category: <?php echo $qualification_category ?></p>
        <p>Education Level:<?php echo $level ?></p>
        <p>Institution:<?php echo $institution ?></p>
        <p>Completion year:<?php echo $completion_year ?></p>

        <!-- Add more education details here -->
        <hr>
        <h3>Work Experience</h3>
        <p>Software Engineer</p>
        <p>Example Company</p>
        <p>Duration: 2018-2021</p>
        <!-- Add more work experience details here -->



        <hr>
        <? include 'certificate.php' ?>
        <h3>Certification</h3>
        <p><? echo $title ?></p>
        <p><? echo $category ?></p>
        <p><? echo $institution ?></p>
        <p><? echo $completion_year ?></p>
        <p><? echo $certificate_link ?></p>


    </div>
</div>