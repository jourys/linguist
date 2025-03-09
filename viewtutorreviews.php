<?php
session_start(); // Start the session
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit(); 
}else{
  if(isset($_POST['tutor_id'])){
    $_SESSION['tutor_id']=$_POST['tutor_id'];
  $tutor_id=  $_SESSION['tutor_id'];
  }}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../header_folder/headerLearner.css">
  <script src="https://kit.fontawesome.com/59189109f7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="../css/tutorRate.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rates and Reviews</title>
</head>

<body>
  
  <?php
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

                <li class="account-list"><a href="EditProfile.html">
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
  <div class="backg">
    <section class="box-content">
      <div class="containing-div">
        <div class="request_div inner-div">
          <h1 id="result-header">Rate and Review!</h1>
          
          <div class="week-sessions">
           <?php
           

           function displayAllrate()
           {
             if(isset($_POST['tutor_id'])){
               $_SESSION['tutor_id']=$_POST['tutor_id'];
             $tutor_id=  $_SESSION['tutor_id'];
             include("connection.php");
             $sql = "SELECT starts, ReviewText FROM review WHERE P_id = '$tutor_id' ";
             $sessions_result = mysqli_query($conn, $sql);
         
             // Check if there are any sessions for this tutor
             if (mysqli_num_rows($sessions_result) > 0) {
               // Loop through the sessions and display each session card
               while ($session_row = mysqli_fetch_assoc($sessions_result)) {
                 $stars = $session_row['starts'];
                 $reviewText = $session_row['ReviewText'];
         
                 // Output the session card HTML
                 echo '<div class="result-cell">';
                 echo ' <div class="acc-info">';
                 // Output the session details
                 echo '<p class="rating"><i class="fa-solid fa-star"></i> ' . $stars . '</p>';
                 echo '<p>' . $reviewText . '</p>';
                 // Output other session information (e.g., day, language, etc.)
                 echo '</div>'; // Close the learner-info div
                 echo '</div>'; // Close the request-card div
               }
             } else {
               // If no sessions are found, display a message
               echo '<h2>No ratings found.</h2>';
             }
           }
         }
         
         
         include("ratet.php");
         
?>
          </div>
        </div>
 </div></section></div>


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
