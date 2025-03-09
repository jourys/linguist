<?php
   // $conn = mysqli_connect($dbServername, $dbusername, $dbpassword, $dbName);
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
  // Redirect the user to the login page
  header("Location: login.php");
  exit(); // Stop further execution
}

//include("php/learnerhp.php");
include("learnerInfo.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Learner Home</title>
  <link rel="stylesheet" type="text/css" href="../css/HomePageLearner.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" type="text/css" href="../css/sidebar-tutor.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="../header_folder/headerLearner.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<script src="https://kit.fontawesome.com/5a18e3112f.js" crossorigin="anonymous"></script>

<body>

  <?php

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
      return "../images/profile.png";
  }
}
  $today = date("Y-m-d");
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM session WHERE L_id='$user_id' AND Date= '$today'";
  $Result = mysqli_query($conn, $sql);
  $ResultCheck = mysqli_num_rows($Result);

  if ($ResultCheck > 0) {
  } else {
    echo '<script>console.log("not good!"); </script>';
  }
  ?>
  <?php
  // Function to display this week's sessions
  function displayThisWeekSessions()
  {
    // Include the database connection file
    include("connection.php");
    // Get the current date
    $currentDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime('+7 days'));
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM session WHERE L_id='$user_id' AND Date BETWEEN '$currentDate' AND '$endDate';";
    $weeksesstions = mysqli_query($conn, $sql);

    // Check if there are any sessions for this week
    if (mysqli_num_rows($weeksesstions) > 0) {


      // Loop through the sessions and display each session card
      while ($row = mysqli_fetch_assoc($weeksesstions)) {
        $tutorId = $row['T_id'];
        $sql_tutor = "SELECT * FROM tutor WHERE  id = '$tutorId';";
        $learnThisWeek = mysqli_query($conn, $sql_tutor);
        if ($learnThisWeek) {
          // Fetch the learner's name from the result set
          $learnerRow = mysqli_fetch_assoc($learnThisWeek);
        }

        $dayOfWeek = date('l', strtotime($row['Date']));
        if ($currentDate == $row['Date']) {
          continue;
        }
        echo '<div class="request-card">';
        echo '<div class="learner-info">';
        // Output learner's profile picture
        echo '<img src="../images/' . $learnerRow['image'] . '" alt="profile Picture" />';

        echo '<div class="day">';
        // Output learner's name
        echo '<h5><strong>' . $learnerRow['Firstname'] . ' ' .  $learnerRow['Lastname'] . '</strong></h5>';
        // Output the day of the session
        echo '<p class="day-of-upcoming-sessions">' . $dayOfWeek . '</p>';
        echo '</div></div>';
        echo '<section class="incard-elements">';
        // Output session details "' . getFlagImage($row['language']) . '"
        $flagImage = getFlagImage($row['language']);
        echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language" />' . $row['language'] . '</p>';


        // $flagImage = '<script>getFlagImage("' . $row['language'] . '")</script>' ;
        // echo '<p class="language"><img class="flag" src="' . $flagImage . '" alt="language image" />' . $row['language'] . '</p>';
        echo '<p class="level">' . $row['level'] . '</p>';
        echo '<p class="type"> ' .  date("h:i A", strtotime($row['Time'])) . '</p>';
        echo '<p class="duration">' . $row['Duration'] . ' Minutes</p>';
        echo '</section></div>';
      }
    } else {
      // If no sessions are found, display a message
      echo '<h2>No sessions scheduled for this week.</h2>';
    }
  }

  ?>
  <header id="header">
    <div id="header-div">
      <nav class="fixed-top" id="main-nav">
        <ul id="ul1">
          <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo" id="logo-img"></li>
          <li class="list1-item"><a href="HomePageLearner.php" class="list1-item">Home</a></li>
          <li class="list1-item"><a href="SESSionLearner.php">Sessions</a></li>
          <li class="list1-item"><a href="learnerRequest2.php">Requests</a></li>
          <li class="list1-item"><a href="Supports.php">Support</a></li>
        </ul>
        <ul id="ul2">

          <li id="acnt li">
          <nav id="account-nav"><img src="../images/<?php echo $row['image']; ?>" width="25" alt="pic" />
              <ul>

                <li class="account-list"><a href="EditProfile.php">
                    <div class="circle"></div>Edit Profile
                  </a></li>
                  <li class="account-list"><a href="logout.php">
                    <div class="circle"></div>Log Out
                  </a></li>
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
        <img src="../images/<?php echo $row['image']; ?>" width="25" alt="pic" />
          <h2><?php
  $learner_id = $_SESSION['user_id'];
  $sql = "SELECT Firstname, Lastname FROM learner WHERE ID = '$learner_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $first_name = $row["Firstname"]; 
    $last_name = $row["Lastname"];
    echo  $first_name." ".$last_name;
  } else {
    echo "Learner with ID " . $learner_id . " not found.";
  }
?></h2>

          <p id="bio"></p>
        </div>


        <div class="card-body">

          <ul class="stats">
            <li id="hours">
              <i class="fa-solid fa-clock"></i>
              <span>Total Hours of Studying</span>
              <span><?php echo $totalHours ?></span>
            </li>
            <li id="Languages">
              <span>Learning Languages</span>
              <?php
  $learner_id = $_SESSION['user_id'];
  $sql = "SELECT language FROM session WHERE ID = '$learner_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $l = $row["language"]; 
    echo  $l;
  } else {
    echo "";
  }
?>
            </li>
           
            <li>
              <span>Achievements</span>
              <span>
                <i class="fa-solid fa-gift"></i>
                <i class="fa-solid fa-handshake"></i>
                <!-- Add more achievements as needed -->
              </span>
            </li>

            <li>
              <hr>
              <i class="fa-solid fa-user"></i>
              <!-- add icons -->
              <a id="profile-settings" href="EditProfile.php">Profile Settings</a>
            </li>


          </ul>
        </div>
      </div>
    </aside>

    <section class="center">
      <section class="sessions">
        <section class="request-post">
          <h3>Let's Get Started!</h3>
          <p>Start posting requests to find the perfect language learning partner!</p>
          <a href="learnerRequest2.php"><button>Post Request</button></a>


        </section>
      </section>
      <section class="sessions">

        <h3>This Week's Sessions</h3>
        <br>
        <section class="week-sesstoin">
          <?php displayThisWeekSessions(); ?>
        </section>
        <br>
        <a href="SESSionTutor.php"> <button class="view-more-button">View All Sessions</button></a>
        
      </section>


      <section class="sessions">
        <h3>Recommended Partners </h3>
        <br>
        <section class="requests">

            <div class="week-sesstoin">
              <?php
    

    $query = "SELECT * FROM review WHERE starts >= 4";
    $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            
            
            if (isset($row['image'])) {
              
              echo '<img src="../images/' . $row['image'] . '" width="25" alt="pic" />';
            } else {
              echo '<img src="../images/teacher.jpg" alt="profile Picture">'; // Default image
            }
            $tutorId= $row['P_ID'];
            $sql_t = "SELECT * FROM tutor WHERE  id = '$tutorId';";
            $t = mysqli_query($conn, $sql_t);
            if ($t) {
             $r=mysqli_fetch_assoc($t);
             $Price = $r["Price"];
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

              echo '<h6><strong><i class="fa-solid fa-user"></i>' . $r['Firstname'] . '</strong></h6>';
            
            }
            echo '</div>';
            echo '<section class="incard-elements">';
            echo '<p class="rating"><i class="fa-solid fa-star"></i> ' . (isset($row['starts']) ? $row['starts'] : '') . ' <i class="fa-solid fa-dollar-sign"></i> ' . (isset($row['ReviewText']) ? $row['ReviewText'] : '') . '</p>';
            echo '</section>';
            echo ' <form method="POST" action="tutor_profile_page.php">
            <fieldset>
                <div class="fieldset-container" id="part-rec-post">
                  <input type="hidden" name="tutor_id" value="'. $tutorId  .'">
                  <input type="hidden" name="language" value="'.  $tutorLanguages[0] .' ?>">
                  <input type="hidden" name="Price" value="'. $Price.  '">
                <div class="btn-container">
                    <button type="submit" class="view-more-button" id="postReq-btn">view more detailes</button>
                </div>
            </div>
            </fieldset>
        </form> ';

            echo '</div>';
            
          }
        } else {
          echo '<p>No recommended partners available.</p>';
        }
        
        mysqli_close($conn);
        ?>
        
            </div>
        </section>
        <a href="learnerRequest2.php"> <button class="view-more-button">View More Partners</button></a>

      </section>

    </section>


  </section>


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
</body>

</html>
