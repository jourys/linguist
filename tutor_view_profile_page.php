<?php


include('connection.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); 
} 
 include("tutorsInfo.php");


function displayTutorReviews() {
$tutorId = $_SESSION['user_id'] ;
///888888888888888888888888888888888888888888888888888888888888888888888888888
include('connection.php');
    $sql = "SELECT * FROM review WHERE P_ID = '$tutorId' LIMIT 4";
    $result = mysqli_query($conn, $sql);

    
    if(mysqli_num_rows($result) > 0) {
     
        while($row = mysqli_fetch_assoc($result)) {
          $learner_id = $row['L_ID'];
          $sqlLearner = "SELECT * FROM learner WHERE ID = '$learner_id'";
          $resultLearner = mysqli_query($conn, $sqlLearner);
          if(mysqli_num_rows($resultLearner) > 0) {
              $learnerData = mysqli_fetch_assoc($resultLearner);
              $learner_name = $learnerData['Firstname'] . ' ' . $learnerData['Lastname'];
              $lImage = $learnerData['image'];
          } else {
              $learner_name = "Unknown"; // Default value if learner is not found
          }
            echo '<div class="result-cell">';
            echo '<div class="acc-info">';

            echo '<img class="result-img" src="../images/'.$lImage.'">'; 
            echo '<h6 class="name"><i class="fa-solid fa-user"></i> ' .$learner_name . '</h6>'; 
            echo '<div class="more-info">';
            echo '<h6>' . $row['starts'] . ' <i class="fa-solid fa-star"></i></h6>';
            echo '<div class="session-info">';
            echo '<p>' . $row['ReviewText'] . '</p>';
            echo '</div>'; 
            echo '</div>'; 
            echo '</div>'; 
            echo '</div>'; 
        }
    } else {
        // If no reviews 
        echo '<h2>No reviews found for this tutor.</h2>';
    }
    
}
?>





<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../header_folder/headerPartner.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/tutor_profile_page.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
        <link rel="stylesheet" href="css/tutorAvailableTimes.css">
        <!-- <link rel="stylesheet" href="css/calendar.css"> -->
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    </head>
    <body>
        <header>
            <div id="header-div">
                <nav class="fixed-top" id="main-nav">
                    <ul id="ul1">
                        <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                        <li class="list1-item"><a href="tutor_Home_page.php" class="list1-item">Home</a></li>
                        <li class="list1-item"><a href="SESSionTutor.php">Sessions</a></li>
                        <li class="list1-item"><a href="tutorReq.php">Requests</a></li>
                        <li class="list1-item"><a href="toturRate.php">Rates and Reviews</a></li>
                        <li class="list1-item"><a href="SupportsPartner.php">Support</a></li>
                    </ul>
                    <ul id="ul2">
                        
                        <li id="acnt li">
                            <nav id="account-nav"><img src="../images/<?php echo  $image?>" id="account-img">
                                <ul>
                                    
                                    <li class="account-list"><a href="EditProfileP.php"><div class="circle"></div>Edit Profile</a></li>
                                    
                                    <li class="account-list"><a href="logout.php"><div class="circle"></div>Log Out</a></li>
                                </ul>
            
                            </nav>
                        </li>
                    </ul>
                </nav>
            </div>
            
        </header>
        <div class="main-body-conteniar">
            <div  class="main-body-content">
                <section class="pp-for-tutor">
                    
                        <img id = "image-of-tutor"src="../images/<?php echo  $image?>" alt="Profile Picture">
                        <h2><?php echo $firstname.' '.  $lastname ?></h2>
                    
                </section>
                <section>

                    <h2>bio</h2>
                    <p id="bio"><?php echo $bio; ?></p>
                    <h2>Languages</h2>
                    <?php displayLanguages() ;?>
                </section>
                <section class="Contact_tutor">
                    <h2>Contact</h2>
                    <div class= "Contact_tutor_div">
                            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?>
                            <span class="fas fa-envelope"></span>
                          </a>
                    </div>

                    <div class= "Contact_tutor_div">
                    <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?>
                            <span class="fas fa-phone-alt"></span>
                          </a>
                    </div>
                </section>
        
                <section>
                    <h2>education</h2>
                    <?php echo $eduction?>
                </section>
                <section>
                    <h2>experiences</h2>
                    <?php echo $experience?>
                </section>
                <section>
                    <h2>Reviews</h2>
                    <?php displayTutorReviews(); ?>
                   
                    <a href="toturRate.php">
            <button class="view-more-button">View All Reviews</button></a >
                        
                </section>
                <a href="EditProfileP.php">
            <button class="view-more-button">Edit Profile </button></a >
             




        </div>


  
  
        </div>
        <footer>
            <div class="main-content">
                <div class="left box">
                  <h2>About us</h2>
                  <div class="content">
                    <p> Embark on a linguistic journey with LINGUIST. Connect with native speakers worldwide,
                         hone your language skills through immersive experiences, and unlock new cultures from the comfort of your home.<a class="find-more" href="About_us_pageMain.html">Find more</a></p>
                    <div class="social">
                      <a href="#"><span class="fab fa-facebook-f"></span></a>
                      <a href="#"><span class="fab fa-twitter"></span></a>
                      <a href="#"><span class="fab fa-instagram"></span></a>
                      <a href="#"><span class="fab fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
        
                <div class="center box">
                  <h2>Address</h2>
                  <div class="content">
                    <div class="place">
                      <span class="fas fa-map-marker-alt"></span>
                      <span class="text">Riyadh, KSA</span>
                    </div>
                    <div class="phone">
                      <span class="fas fa-phone-alt"></span>
                      <span class="text">+966-505432100</span>
                    </div>
                    <div class="email">
                      <span class="fas fa-envelope"></span>
                      <span class="text"><a href="mailto:content@linguist.com">content@linguist.com</a>
                        </span>
                    </div>
                  </div>
                </div>
        
                <div class="right box">
                  <h2>Contact us</h2>
                  <div class="content">
                    <form action="#" method="post">
                      <div class="email">
                        <div class="text">Email <span class="required">*</span></div>
                        <input type="email" required>
                      </div>
                      <div class="msg">
                        <div class="text">Message <span class="required">*</span></div>
                        <textarea rows="2" cols="25" required></textarea>
                      </div>
                      <div class="btn">
                        <button type="submit">Send</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="bottom">
                <section>
                  <span class="credit">Created By <a href="main.html">linguist</a> | </span>
                  <span class="far fa-copyright"></span><span> 2024 All rights reserved.</span>
                </section>
              </div>
        </footer>
      

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery CDN -->
<script src="js/tutors.js"></script>



       
    </body>
</html>