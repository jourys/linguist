<?php

include('connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); 
} else {

  $user_id=$_SESSION['user_id'];
  $sql = "SELECT * FROM learner WHERE ID = '$user_id';";
  $result = mysqli_query($conn, $sql);
  
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the name from the result set
      $row = mysqli_fetch_assoc($result);
        
      $imageL=$row["image"];
  
  }
    // Check if the form has been submitted with a tutor ID
    if(isset($_POST['tutor_id'])) {
        $selectedTutorId =  $_POST['tutor_id'];
        $selectedLanguage =$_POST['language'];

        // Prepare and execute the SQL query to fetch tutor information
        $sqlT = "SELECT * FROM tutor WHERE ID = '$selectedTutorId'";
        $result =  mysqli_query($conn, $sqlT);
        
        if($result) {
            // Check if tutor information is found
            if(mysqli_num_rows($result) > 0) {
                // Fetch tutor data
                $tutorData = mysqli_fetch_assoc($result);
                // Extract tutor data here...
                $email = $tutorData['Email'];
                            $image = $tutorData['image'];
                            $firstname = $tutorData['Firstname'];
                            $lastname = $tutorData['Lastname'];
                            $age = $tutorData['age'];
                            $gender = $tutorData['gender'];
                            $password = $tutorData['password'];
                            $phoneNumber = $tutorData['PhoneNumber'];
                            $city = $tutorData['city'];
                            $bio = $tutorData['bio'];
                            $experience = $tutorData['experience'];
                            $education = $tutorData['eduction'];
                            $Price = $tutorData['Price'];
                
                // Output other tutor information as needed
            } else {
                echo "No tutor found with ID: $selectedTutorId";
            }
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
    } else {
        echo "Tutor ID not provided.";
    }
}

function displayLanguages() {
    $tutorId = $GLOBALS ['selectedTutorId'] ;
    include("connection.php");
    $tutorsLagsQuery ="SELECT * FROM tutor_languages WHERE P_ID = '$tutorId'";
    $tutorsLagsResult=mysqli_query($conn, $tutorsLagsQuery);
    $tutorLanguages =array();
    
    if ($tutorsLagsResult && mysqli_num_rows($tutorsLagsResult) > 0) {
        // Fetch the name from the result set
        while ($tutorsLags = mysqli_fetch_assoc($tutorsLagsResult)) {
            // Add the language to the array
            $tutorLanguages[] = $tutorsLags['Language'];
        }
    }



    // Check if the array is not empty
    if (!empty($tutorLanguages)) {

        // Loop through each language in the array
        foreach ($tutorLanguages as $language) {
            // Echo the language
            echo $language;

            // If it's not the last language, add a comma and space
            if ($language !== end($tutorLanguages)) {
                echo ', ';
            }
        }

        
    }
}

function displayTutorReviews() {
$tutorId = $GLOBALS ['selectedTutorId'] ;
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
mysqli_close($conn);
?>





<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../header_folder/headerPartner.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/tutor_profile_page.css">
        <link rel="stylesheet" href="../css/learnerRequest2.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
        <link rel="stylesheet" href="css/tutorAvailableTimes.css">
        <!-- <link rel="stylesheet" href="css/calendar.css"> -->
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- //extras -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->


    </head>
    <body>
        <header>
            <div id="header-div">
                <nav class="fixed-top" id="main-nav">
                    <ul id="ul1">
                        <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                        <li class="list1-item"><a href="HomePageLearner.php" class="list1-item">Home</a></li>
                          <li class="list1-item"><a href="SESSionLearner.php">Sessions</a></li>
                          <li class="list1-item"><a href="learnerRequest2.php">Requests</a></li>
                          <li class="list1-item"><a href="Supports.php">Support</a></li>
                    </ul>
                    <ul id="ul2">
                        
                        <li id="acnt li">
                            <nav id="account-nav"><img src="../images/<?php echo  $imageL?>" id="account-img">
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
                    <h2> <?php echo $Price; ?>$ Per hour</h2>
                </section>
                <section class="Contact_tutor">
                    <h2>Contact</h2>
                    <div class= "Contact_tutor_div">
                            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?>
                            <span class="fas fa-envelope"></span>
                          </a>
                    </div>

                    <div class= "Contact_tutor_div">
                    <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?>
                            <span class="fas fa-phone-alt"></span>
                          </a>
                    </div>
                </section>
        
                <section>
                    <h2>education</h2>
                    <?php echo $education?>
                </section>
                <section>
                    <h2>experiences</h2>
                    <?php echo $experience?>
                </section>
                <section>
                    <h2>Reviews</h2>
                    <?php displayTutorReviews(); ?>
                    <form method='POST' action='viewtutorreviews.php'>
                <fieldset>
                    <div class="fieldset-container">
                      <input type="hidden" name="tutor_id" value="<?php echo $selectedTutorId  ?>">
                    <div class="btn-container">
                        <button type="submit" class="view-more-button" id="postReq-btn">View Reviews</button>
                    </div>
                </div>
                </fieldset>
            </form>
                  </section>
                <h2>Book a Session</h2>

               <form method='POST' action='postRequest.php'>
                <fieldset>
                    <div class="fieldset-container">
                      <input type="hidden" name="tutor_id" value="<?php echo $selectedTutorId  ?>">
                      <input type="hidden" name="language" value="<?php echo  $selectedLanguage  ?>">
                      <input type="hidden" name="Price" value="<?php echo $Price  ?>">
                    <div class="btn-container">
                        <button type="submit" class="view-more-button" id="postReq-btn">Post A Request</button>
                    </div>
                </div>
                </fieldset>
            </form> 

              <script>
function sendData(id) {
  window.location.href = "viewtutorreviews.php?id=" + id;
}
</script>





        </div>


  
  
        </div>
        <script>
 
    </script>
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
