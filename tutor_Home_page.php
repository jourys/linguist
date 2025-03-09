<?php 
// if(!isset($_SESSION['user_id'])){
// header("Location: php/login.php");


// }
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

include("tutorsInfo.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Tutor Home</title>
    <link rel="stylesheet" type="text/css" href="../css/css-for-tutor-home.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/sidebar-tutor.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="../header_folder/headerPartner.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

<?php 
DEFINE('DB_user','root');
DEFINE('DB_PSWD','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','linguist');

if(!$conn = mysqli_connect(DB_HOST,DB_user,DB_PSWD,DB_NAME)){
  
  die("connection failed. ");
}
 

  if(!mysqli_select_db($conn,DB_NAME)){
    
    echo '<script>console.log(" no db!"); </script>'; 

    die("could not open the ".DB_NAME."database");
  }
  function getFlagImage($language) {
    // Define a map of language names to flag image directories
    $languageFlags = array(
        "French" => "france.png",
        "German" => "germanyy.png",
        "English" => "united-states.png",
        "Arabic" => "flag.png"
        // Add more language-flag mappings as needed
    );

    // Check if the provided language is in the map
    if (array_key_exists($language, $languageFlags)) {
        // Return the corresponding flag image directory
        return "../images/" . $languageFlags[$language];
    } else {
        // If the language is not found, return a default flag image
        return "../images/default-flag.png";
    }
}

?>
    
  </head>
  <script
    src="https://kit.fontawesome.com/5a18e3112f.js"
    crossorigin="anonymous"
  ></script>

  <body>

  <?php
  
// Get today's date
$today = date("Y-m-d");
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM session WHERE T_id='$user_id' AND Date= '$today'";
$Result = mysqli_query($conn,$sql);
$ResultCheck = mysqli_num_rows($Result);

// if($ResultCheck > 0) {
  //SESSionTutor.php

// } else {
//   echo '<script>console.log("not good!"); </script>'; 
// }
?>
<?php
// Function to display this week's sessions
function displayThisWeekSessions() {
    // Include the database connection file
    include("connection.php");
// Get the current date
$currentDate = date('Y-m-d');

// Calculate the date 7 days from now
$endDate = date('Y-m-d', strtotime('+7 days'));
$userT_id = $_SESSION['user_id'];
// Construct the SQL query to select sessions within the next 7 days
$sql = "SELECT * FROM session WHERE T_id='$userT_id' AND Date BETWEEN '$currentDate' AND '$endDate';";
$weeksesstions = mysqli_query($conn,$sql);

    // Check if there are any sessions for this week
    if (mysqli_num_rows($weeksesstions) > 0) {
   

        // Loop through the sessions and display each session card
        while ($row = mysqli_fetch_assoc($weeksesstions)) {
          $learnerId = $row['L_id'];
          $sql_learner = "SELECT * FROM learner WHERE  id = '$learnerId';";
          $learnerThisWeek = mysqli_query($conn, $sql_learner);
          if ($learnerThisWeek) {
            // Fetch the learner's name from the result set
            $learnerRow = mysqli_fetch_assoc($learnerThisWeek);}

          $dayOfWeek = date('l', strtotime($row['Date']));
if($currentDate == $row['Date']){
continue;
}
            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            // Output learner's profile picture
            echo '<img src="../images/' . $learnerRow['image'] . '" alt="profile Picture" />';

            echo '<div class="day">';
            // Output learner's name
            echo '<h5><strong>' . $learnerRow['Firstname'].' '.  $learnerRow['Lastname'] . '</strong></h5>';
          
            echo '<p class="day-of-upcoming-sessions">' . $dayOfWeek . '</p>';
            echo '</div></div>';
            echo '<section class="incard-elements">';
           
            $flagImage =getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
            
            echo '<p class="level">' . $row['level'] . '</p>';
            echo '<p class="type"> '.  date("h:i A", strtotime($row['Time'])). '</p>';
            echo '<p class="duration">' . $row['Duration'] . ' Minutes</p>';
            echo '</section></div>';
        }
    } else {
      echo '<h2 class="light">you have no sessions for This week</h2>';
    }

}

?>


<header>
            <div id="header-div">
                <nav class="fixed-top" id="main-nav">
                    <ul id="ul1">
                        <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                        <li class="list1-item"><a href="#" class="list1-item">Home</a></li>
                        <li class="list1-item"><a href="SESSionTutor.php">Sessions</a></li>
                        <li class="list1-item"><a href="tutorReq.php">Requests</a></li>
                        <li class="list1-item"><a href="toturRate.php">Rates and Reviews</a></li>
                        <!-- <li class="list1-item">  
                           <form action="tutor_profile_page.php" method="post">
                              <input type="hidden" name="tutor_id" value="<?php // echo $user_id; ?>">
                              <button type="submit" class="list1-item">rrtrtsrhsmlth</button>
                          </form></li> -->

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
    <section class="continer">
      <aside class="sidebar">
        <div class="sidebar-card">
          <div class="card-body-profile">
            <img src="../images/<?php echo $image; ?>" alt="Profile Picture" />
            <!-- <h2>Gloria Harold</h2> -->
            <h2><?php echo $firstname . ' ' . $lastname ?> </h2>
            <p id="bio"><?php echo $bio ?></p>
          </div>

          <div class="card-body">
            <ul class="stats">
              <li id="hours">
                <i class="fa-solid fa-clock"></i>
                <span>Total Hours of Teaching</span>
                <span><?php echo $totalHours ?></span>
              </li>
              <li id="earnings">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Total Earnings</span>
                <span>$<?php echo $totalEarnings?></span>
              </li>
              <li id="Rating">
                <a href="toturRate.php" id="rating-anchor">
                  <i class="fa-solid fa-star"></i>
                  <span>Rating</span>
                  </a>
                  <?php
                  if(!isset($averageRating)){
                    $averageRating =0;
                     $totalReviews = 0;
                  }
                   ?>
                  <span><?php echo $averageRating .'('. $totalReviews .'Ratings)'?></span>
                </a>
              </li>
              <li id="Languages">
                <span>Teaching Languages</span>
                <span> <?php displayLanguages(); ?></span>
              </li>
              <!-- <li id="Cultural backgrounds">
                <span>Cultural backgrounds</span>
                <img class="flag" src="../images/flag.png" alt="KSA" />
                <img class="flag" src="../images/france.png" alt="French" />
              </li> -->
              <!-- <li>
                <span>Achievements</span>
                <span>
                  <i class="fa-solid fa-gift"></i>
                  <i class="fa-solid fa-handshake"></i>
                 
                </span>
              </li> -->
              <li>
                <hr />
                <i class="fa-solid fa-user"></i>
                <!-- add icons -->
                <a id="profile-settings" href="tutor_view_profile_page.php"
                  >view Profile </a
                >
              </li>
              <li>
                <hr />
                <i class="fa-solid fa-user"></i>
                <!-- add icons -->
                <a id="profile-settings" href="EditProfileP.php"
                  >Profile Settings</a
                >
              </li>
            </ul>
          </div>
        </div>
      </aside>

      <section class="center">
        <section class="sessions-day">
          <section name="current-sessions" class="current-sessions">
            <h3>Today's Sessions</h3>

            <section class="Today-sessions">

      

                  <?php
                 
                  $ended_Sessions =array();

                  if($ResultCheck > 0) {
                          while($row = mysqli_fetch_array($Result) ) {
                            $learnerId = $row['L_id'];
                            $learnerQuery = "SELECT Firstname,Lastname,image FROM learner WHERE  id = '$learnerId'";
                            $learnerResult = mysqli_query($conn, $learnerQuery);
                            if ($learnerResult) {
                              // Fetch the learner's name from the result set
                              $learnerRow = mysqli_fetch_assoc($learnerResult);}
                              $sessionStartTime = strtotime($row['Time']);
                              $sessionDuration = $row['Duration'];
                            
                              // Get the current time
                              $currentTime = time();
                          
                              // Calculate the end time of the session
                              $sessionEndTime = $sessionStartTime + ($sessionDuration * 60); // Convert duration to seconds
                          
                              // Check if the session has started and has not ended yet
                              if ($currentTime >= $sessionStartTime && $currentTime < $sessionEndTime) {
                                  // Session is ongoing, display "Join"
                                  $buttonText = "Join";
                                  $Button_color="enter-btn-current";
                              } elseif ($currentTime < $sessionStartTime) {
                                  // Session has not started yet, display the start time
                                  $buttonText = date("h:i A", $sessionStartTime);  // Format the start time as desired
                                  
                                  $Button_color="enter-btn";
                              } else {
                                $ended_Sessions[] = array(
                                  'learner_name' => $learnerRow['Firstname'] . ' ' . $learnerRow['Lastname'],
                                  'language' => $row['language'],
                                  'level' => $row['level'],
                                  'start_time' => date("h:i A", $sessionStartTime),
                                  'duration' => $row['Duration'],
                                  'image' => $learnerRow['image']
                              );
                                  // Session has ended, display something else or hide the button
                                  $buttonText = "Session ended";
                                  $Button_color="enter-btn-done" ;
                                  continue;
                              }
                            ?>
                             <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="../images/<?php echo  $learnerRow['image']?>"
                    alt="current-session"
                  />    
                           <?php echo '<script>console.log(" good!"); </script>';
                           
                          $flagImage =getFlagImage($row['language']);
                       
                           ?>
                             <div class="card-inner">
                             <h4><strong><?php echo $learnerRow['Firstname'].' '.  $learnerRow['Lastname']?></strong></h4>
                           <section class="incard-elements-sessions">
                           <p class="language">
                           <img
                          class="flag"
                          src="<?php echo $flagImage ?>"
                          alt=" flag"
                        />
                           <?php echo $row['language'] ?>
                          
                          
                          </p>
                           <p class="level"><?php echo $row['level'] ?></p>
                           <p class="time"><?php echo date("h:i A", $sessionStartTime) ?>
                            <p class="duration"><?php echo $row['Duration']?> Minutes</p>
                          </section>
                           <a class="<?php echo $Button_color ?>" href="#" ><?php echo $buttonText ?></a>
                          </div>
                </div>
                             </div>
                            <?php
                          }
                        } else {
                          echo '<script>console.log("not good!"); </script>'; 
                          echo '<h2 class="light">you have no sesstions for Today</h2>';
                        }
                      ?>
                       <?php
                       if(count($ended_Sessions) > 0) {
                       
                       foreach ($ended_Sessions as $session): ?>

                <div class="current-sessions-card">
                <div class="carousel-cell">
                  <img
                    class="current-session-img"
                    src="../images/<?php echo  $session['image']?>"
                    alt="ended-session"
                  />    <div class="card-inner">
                    <h4><strong><?php echo $session['learner_name']; ?></strong></h4>
                    <section class="incard-elements-sessions">
                    <p class="language"><?php echo $session['language']; ?></p>
                    <p class="level"><?php echo $session['level']; ?></p>
                    <p class="start-time"><?php echo $session['start_time']; ?></p>
                    <p class="duration"><?php echo $session['duration']; ?> Minutes</p>
                    </section>
                        </div>
                </div>
           </div>
        <?php endforeach;} ?>

            </section>
          </section>
          <!--  -->
        </section>

        <section class="sessions">
          <h3>This Week's Sessions</h3>
          <br />
          <section class="week-sesstoin">
               <?php displayThisWeekSessions(); ?>
           
          </section>
             <br>
          <a href="SESSionTutor.php">
            <button class="view-more-button">View All Sessions</button></a
          >
        </section>


                <section class="new-requests-container">
                    <h3>Newest Requests </h3>
                    <br>
                    <section class="requests">
                        
                      <?php getClosestDateRequests(); ?>
                       
                    </section>
                    <a href="tutorReq.php"> <button class="view-more-button">View All Requests</button></a>

                </section>

                </section>
            </section>
    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>
              Embark on a linguistic journey with LINGUIST. Connect with native
              speakers worldwide, hone your language skills through immersive
              experiences, and unlock new cultures from the comfort of your
              home.<a class="find-more" href="About_us_pageMain.html"
                >Find more</a
              >
            </p>
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
              <span class="text"
                ><a href="mailto:content@linguist.com">content@linguist.com</a>
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
                <input type="email" required />
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
          <span class="credit"
            >Created By <a href="main.html">linguist</a> |
          </span>
          <span class="far fa-copyright"></span
          ><span> 2024 All rights reserved.</span>
        </section>
      </div>
    </footer>
  </body>
</html>
<?php
mysqli_close($conn);
?>
