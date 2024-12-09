   <!-- ======= Doctors Section ======= -->
   <section id="doctors" class="doctors section-bg">
       <div class="container" data-aos="fade-up">

           <div class="section-title">
               <h2>EXECUTIVE COMMITTEE</h2>
           </div>

           <div class="row">
               <?php
                    ini_set('display_startup_errors', 1);
                    ini_set('display_errors', 1);
                    error_reporting(-1);
          // Include your database connection file
          include('https://admin.tapa.or.tz/db.php');

          // Fetch leaders from the executive_committee table
          $query = "SELECT * FROM executive_committee";
          $result = mysqli_query($conn, $query);

          // Check if there are leaders in the database
          if ($result) {
            // Loop through the result and display each leader
            while ($row = mysqli_fetch_assoc($result)) {
              $image = $row['image_url'];  
              $name = $row['name'];  
              $role = $row['position'];  
              $twitter = $row['twitter_link'];  
              $facebook = $row['facebook_link'];  
              $instagram = $row['instagram_link'];  
              $linkedin = $row['linkedin_link']; 
          ?>

               <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                   <div class="member" data-aos="fade-up" data-aos-delay="100">
                       <div class="member-img">
                           <img src="https://admin.tapa.or.tz/<?php echo $image; ?>" class="img-fluid" alt="">
                           <div class="social">
                               <a href="<?php echo $twitter; ?>"><i class="bi bi-twitter"></i></a>
                               <a href="<?php echo $facebook; ?>"><i class="bi bi-facebook"></i></a>
                               <a href="<?php echo $instagram; ?>"><i class="bi bi-instagram"></i></a>
                               <a href="<?php echo $linkedin; ?>"><i class="bi bi-linkedin"></i></a>
                           </div>
                       </div>
                       <div class="member-info">
                           <h4><?php echo $name; ?></h4>
                           <span><?php echo $role; ?></span>
                       </div>
                   </div>
               </div>

               <?php
            }
          } else {
            echo "<p>No leaders found.</p>";
          }
          ?>

           </div>

       </div>
   </section>

   <!-- End Doctors Section -->