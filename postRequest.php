<?php
    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','linguist');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD))
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");


  
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); 
}else{
  if(isset($_POST['tutor_id'])) {
  $_SESSION['language']= $_POST['language'];
  $_SESSION['tutor_id']= $_POST['tutor_id'];
  $_SESSION['Price']= $_POST['Price'];
  $user_id=$_SESSION['user_id'];
  $sql = "SELECT * FROM learner WHERE ID = '$user_id';";
  $result = mysqli_query($conn, $sql);
  
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the name from the result set
      $row = mysqli_fetch_assoc($result);
        
      $image=$row["image"];
  
  }

  }
}
?>

<!DOCTYPE html>
<html>
    <head>  
        <title>Post Request</title>
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/tutorReq.css">
         <link rel="stylesheet" href="../header_folder/headerPartner.css">
        <link rel="stylesheet" href="../css/EditRequest.css">
        
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>

        <header id="header">
            <div id="header div">
            <nav class="fixed-top" id="main-nav">
                <ul id="ul1">
                  <li id="disabled"><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img" ></li>
                  <li class="list1-item"><a href="HomePageLearner.php" class="list1-item">Home</a></li>
                  <li class="list1-item"><a href="SESSionLearner.php">Sessions</a></li>
                  <li class="list1-item"><a href="learnerRequest2.php">Requests</a></li>
                  <li class="list1-item"><a href="RateAndReview.php">Rate and Review</a></li>
                  <li class="list1-item"><a href="Supports.php">Support</a></li>
                </ul>
                <ul id="ul2">
                    <li id="acnt li">
                        <nav id="account-nav"><img src="../images/<?php echo  $image?>" id="account-img">
                            <ul>
                                
                               <li class="account-list"><a href="EditProfile.php"><div class="circle"></div>Edit Profile</a></li> 
                                <li class="account-list"><a href="logout.php"><div class="circle"></div>Log Out</a></li>
                            </ul>

                        </nav>
                    </li>
                </ul>
            </nav>
        </div>
         </header>

         <main>
            <div class="containing-div">

                <div class="request_div inner-div">
                    <h5 id="edit-req-header">Specify Your Request Details</h5>
                   
                            <div class="fieldset-container">
                            <div class="select-container">
                              
        
                               
                            <form method='GET' action='<?php $_SERVER['PHP_SELF'] ?>'>
                <fieldset>
                    <div class="fieldset-container">
                    <div class="select-container">
                        <!-- <label>Language<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="Language">  
                                    <option></option>
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <option>Arabic</option>
                                </select>
                            </div>
                        </label> -->

                        <label name="level">Level<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="level">
                                    <option></option>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Advanced</option>
                                </select>
                            </div>
                        </label>

                        <label>Duration<br>
                            <div class="selectWrapper">
                                <select class="input-box" name="Duration">
                                    <option></option>
                                    <option>10 Minutes</option>
                                    <option>20 Minutes</option>
                                    <option>30 Minutes</option>
                                    <option>40 Minutes</option>
                                    <option>50 Minutes</option>
                                    <option>60 Minutes</option>
                                </select>
                            </div>
                        </label>

                        <label>Date<br>
                            <div class="selectWrapper" id="datetimepicker">
                                <input class="input-box" type="date" name="date">
                            </div>
                        </label>

                        <label>Time<br>
                            <div class="selectWrapper" id="datetimepicker">
                                <input class="input-box" type="time" name="time">
                            </div>
                        </label>
                    </div>
                    <div class="btn-container">
                        <button type="submit" class="selectWrapper" id="go-btn">Go!</button>
                    </div>
                </div>
                </fieldset>
            </form> </div>
                       
                    </div>
                    </div>
         </main>

         <?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  echo$_GET['level'] .$_GET['Duration']. $_GET['time'];
          if(isset($_GET['level']) && isset($_GET['Duration']) && isset($_GET['time']) && isset($_GET['date']) ){
    
    $level = $_GET['level'];
    $duration = (int)$_GET['Duration'];
    $time = date("H:i:s", strtotime($_GET['time']));
    $date = $_GET['date'];
    $language2 = $_SESSION['language'];
    $tutor_id2= $_SESSION['tutor_id'];
    $Price2 = (double)$_SESSION['Price'];
    if(empty($level) || empty($duration) || empty($time) || empty($date) || empty($language2)){
      echo "Please fill in all fields.";
        } else {
    
          $L_ID = $_SESSION['user_id'];

          $sql = "INSERT INTO request (P_ID, L_ID, Time, Date, Duration, Language, Level ,Status, Price) 
                  VALUES ( '$tutor_id2' , '$L_ID', '$time', '$date', '$duration', '$language2', '$level','pending' , '$Price2' );";

          // Execute the query
          $result = mysqli_query($conn, $sql);

          // Check if the query was successful
                    if ($result) {
                        echo "Request successfully inserted!";
                    } else {
                        echo "Error inserting request: " . mysqli_error($conn);
                        //echo $level.'<br>';
// echo $duration.'<br>';
// echo $time .'<br>';
// echo $date .'<br>';
// echo $language2 .'<br>';
// echo $tutor_id2.'<br>';
// echo $Price2.'<br>';
                    }
  }} else{
    echo "here";
  }
}else{
  echo "no GET";
}
// echo $level;
// echo $duration;
// echo $time ;
// echo $date ;
// echo $language2 ;
// echo $tutor_id2;
// echo $Price2 ;
// $tutor_id2 = $_SESSION['tutor_id'];
// $L_ID = $_SESSION['user_id'];
// $time = date("H:i:s", strtotime($_GET['time']));
// $date = $_GET['date'];
// $duration = (int)$_GET['Duration'];
// $language2 = $_SESSION['language'];
// $level = $_GET['level'];
// $price = $_SESSION['Price'];

// $sql = "UPDATE request 
//         SET Time = '$time', 
//             Date = '$date', 
//             Duration = $duration, 
//             Language = '$language2', 
//             Level = '$level', 
//             Status = 'pending', 
//             Price = $price 
//         WHERE P_ID = $tutor_id2 AND L_ID = $L_ID";

// $result = mysqli_query($conn, $sql);

// if ($result) {
//     echo "Request successfully updated!";
// } else {
//     echo "Error updating request: " . mysqli_error($conn);
// }
// echo $level;
// echo $duration;
// echo $time ;
// echo $date ;
// echo $language2 ;
// echo $tutor_id2;
// echo $Price2 ;
?>


         <footer>
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
                      <span class="text"><a href="mailto:content@linguist.com"></a>
                        content@linguist.com</span>
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
      </footer>

    </body>
</html>
