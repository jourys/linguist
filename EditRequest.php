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
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}
   
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      
            $_SESSION['p_id'] =  $_POST["p_id"];
            $_SESSION['l_id'] =  $_POST["l_id"];
            $_SESSION['time'] =$_POST["time"];
            $_SESSION['date'] = $_POST["date"];
           
        } else {
     
            echo "Form submission method is not POST.";
        }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Request</title>
        <link rel="stylesheet" href="../css/footer.css">
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
                    <h5 id="edit-req-header">Edit Your Request</h5>
                   
                            <div class="fieldset-container">
                            <div class="select-container">
                              
        
                               
        
                               <form type="get">
                               <label>Edit Duration<br>
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

                                <label>Edit Date<br>
                                    <div class="selectWrapper">
                                       <input name= "date" type="date">
                                    </div>
                                </label>
        
                                <label>Edit Time<br>
                                    <div class="selectWrapper">
                                    <input name= "time" type="time">
                                    </div>
                                </label>
                            </div>
                            <div class="btn-container">
                                <button type="submit" class="selectWrapper" id="save-btn">Save Changes</button>
                                <button type="reset" class="selectWrapper" id="discard-btn">Discard Changes</button>
                            </div>
                               </form>
                            <p id="clarification">Level and language can't be changed. Cancel your request and make a new one.</p>
                        </div>
                       
                    </div>
                    </div>
         </main>

         <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      if(isset($_GET["time"]) && isset($_GET["date"]) && isset($_GET["Duration"]) ) {
        $p_id= $_SESSION['p_id'] ;
        $l_id= $_SESSION['l_id'] ;
        $time= $_SESSION['time'] ;
         $date =$_SESSION['date'] ;
          $newTime = $_GET["time"];
          $newDate = $_GET["date"];
          $newDuration = intval($_GET["Duration"]);

          // Prepare and execute the SQL update query
          $sql = "UPDATE request SET Time='$newTime', Date='$newDate', Duration='$newDuration' WHERE P_ID='$p_id' AND L_ID='$l_id' AND Time='$time' AND Date='$date';";
          if (mysqli_query($conn, $sql)) {
              echo "Record updated successfully";
          } else {
              echo "Error updating record: " . mysqli_error($conn);
          }
      } else {
          echo "Please fill out all required fields.";
      }
  } else echo 'hiiii';
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
