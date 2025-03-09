<?php

session_start();
    DEFINE('DB_USER','root');
    DEFINE('DB_PSWD','');
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_NAME','linguist');

    if (!$conn = mysqli_connect(DB_HOST,DB_USER,DB_PSWD))
        die("Connection failed.");

    if(!mysqli_select_db($conn, DB_NAME))
        die("Could not open the ".DB_NAME." database.");

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution


}else{
    $user_id=$_SESSION['user_id'];
  $sql = "SELECT * FROM tutor WHERE ID = '$user_id';";
  $result = mysqli_query($conn, $sql);
  
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the name from the result set
      $row = mysqli_fetch_assoc($result);
        
      $imageT=$row["image"];
  
  }
}

?>
<!DOCTYPE html>
<html>
    <head> 
        <title>Request</title>
        <link rel="stylesheet" href="../css/tutorReq.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../header_folder/headerPartner.css">
        <script src="https://kit.fontawesome.com/59189109f7.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        

    </head>
    <body>

        <header id="header">
            <div id="header-div">
            <nav class="fixed-top" id="main-nav">
                <ul id="ul1">
                    <li><img src="../images/linguistBlueAndWhite.jpg" alt="LINGUIST logo"  id="logo-img"></li>
                    <li class="list1-item"><a href="tutor_Home_page.php" class="list1-item">Home</a></li>
                    <li class="list1-item"><a href="SESSionTutor.php">Sessions</a></li>
                    <li class="list1-item"><a href="tutorReq.php">Requests</a></li>
                    <li class="list1-item"><a href="toturRate.php">Rate and Review</a></li>
                    <li class="list1-item"><a href="SupportsPartner.php">Support</a></li>
                </ul>
                <ul id="ul2">

                    <li id="acnt li">
                         <nav id="account-nav"><img src="../images/<?php echo  $imageT?>" id="account-img">
                            <ul>

                                <li class="account-list"><a href="EditProfileP.php"><div class="circle"></div>Edit Profile</a></li>

                                <li class="account-list"><a href="#"><div class="circle"></div>Log Out</a></li>
                            </ul>

                        </nav>
                    </li>
                </ul>
            </nav>
        </div>
         </header>

         <main class="grid-container">
            <div class="containing-div">
            <div class="new-request_div inner-div">
                    <h5 id="new-req-header">New Requests</h5>
                    <div class="result">
                        
                        <div class="result-carousel">

                        
                        <?php  $ID = $_SESSION['user_id'];
                  $sql = "SELECT * FROM request, learner WHERE P_ID = $ID AND L_ID=learner.ID AND Status='pending'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) { 
                    while($row = mysqli_fetch_assoc($result)) {
                        // Check if the request status is accepted and if it's not already added to the session table
                        if ($row['Status'] == 'accepted') {
                            // Check if the request is not already added to the session table
                            $checkSessionQuery = "SELECT * FROM session WHERE T_id = $ID AND Date = '{$row['Date']}' AND Time = '{$row['Time']}'";
                            $sessionResult = mysqli_query($conn, $checkSessionQuery);
                            if(mysqli_num_rows($sessionResult) == 0) {
                                // If the request is not already added to the session table, add it
                                $insertSessionQuery = "INSERT INTO session (T_id, L_id, Date, Time, Duration, Language, Level, Price, Status) VALUES ($ID, {$row['L_ID']}, '{$row['Date']}', '{$row['Time']}', '{$row['Duration']}', '{$row['Language']}', '{$row['Level']}', '{$row['Price']}', 'accepted')";
                                if(mysqli_query($conn, $insertSessionQuery)) {
                                    echo "Request added to session table successfully.";
                                } else {
                                    echo "Error adding request to session table: " . mysqli_error($conn);
                                }
                            } else {
                                echo "Request is already added to session table.";
                            }
                        }
                        // Render the buttons
                        echo '
                        <div class="result-cell">
                            <div class="acc-info"> <!--row-->
                                <img class="result-img" src="../images/'.$row['image'].'" alt="account image"> <!--column1-->
                                <div class="more-info">
                                    <h5>'.$row['Firstname']. " "  .$row['Lastname'].'</h5>
                                </div>     
                            </div>
                            
                            <div class="specifications-div">
                                <div class="language specifications">'.$row['Language'].'</div>
                                <div class="level specifications">'.$row['Level'].'</div>
                                <div class="duration specifications">'.$row['Duration'].' Minutes</div>
                                <div class="date specifications">'.$row['Date'].'</div>
                                <div class="time specifications">'.date("h:i A", strtotime($row['Time'])).'</div>
                            </div>
                            
                            <form action="tutorReq.php" method="post">
                                <input type="hidden" name="req_date" value="'.$row['Date'].'">
                                <input type="hidden" name="req_time" value="'.$row['Time'].'">
                                <div class="req-options">
                                    <div class="accept-req-btn">
                                        <button type="submit" name="action" value="accept">Accept</button>
                                    </div>
                                    <div class="reject-req-btn">
                                        <button type="submit" name="action" value="reject">Reject</button>
                                    </div>
                                </div>
                            </form>
                        </div>';
                    }
                } else {
                    echo "No New Requests<br>" ;
                }
                
                
                  ?>
                        
                    </div>
                </div></div>
<!---------------------------------------------------------------------------------------------------------------------->
                <?php
               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve data from the form
                $action = $_POST['action'];
                $req_date = $_POST['req_date']; 
                $req_time = $_POST['req_time'];
                $ID = $_SESSION['user_id']; 
                
                // Prepare the SQL statement with embedded values
                $sql = "";
                if ($action === 'accept') {
                    $sql = "UPDATE request SET Status='accepted' WHERE P_ID=$ID AND Date='$req_date' AND Time='$req_time'";
                } elseif ($action === 'reject') {
                    $sql = "UPDATE request SET Status='rejected' WHERE P_ID=$ID AND Date='$req_date' AND Time='$req_time'";
                }
            
                // Execute the SQL statement
                if (mysqli_query($conn, $sql)) {
                    // Success
                    echo "Request status updated successfully.";
                } else {
                    // Error
                    echo "Error updating request status: " . mysqli_error($conn);
                }
            }
            
                
                
                ?>
    
          
        
    
                
<!---------------------------------------------------------------------------------------------------------------------->
                <div class="containing-div">
    
                    <div class="past-request_div inner-div">
                        <h5 id="new-req-header">Previous Requests</h5>
                        <div class="result">
                            
                            <div class="result-carousel">

                          <?php  $ID = $_SESSION['user_id'];
                  $sql = "SELECT * FROM request, learner WHERE P_ID = $ID AND L_ID=learner.ID";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) { 
                    while($row = mysqli_fetch_assoc($result)) {
                      if($row['Status']=='accepted'){
                      echo '<div class="result-cell">
                                                
                      <div class="acc-info"> <!--row-->
                          <img class="result-img" src="../images/'.$row['image'].'" alt="account image"> <!--column1-->
                          <div class="more-info">
                              <h5><i class="fa-solid fa-user"></i>'.$row['Firstname']. " "  .$row['Lastname'].'</h5>
                             
                          </div>     
                      </div>
                      
                      <div class="specifications-div">
                          <div class="language specifications">'.$row['Language'].'</div>
                          <div class="level specifications">'.$row['Level'].'</div>
                          <div class="duration specifications">'.$row['Duration'].' Minutes</div>
                          <div class="time specifications">'.date("h:i A", strtotime($row['Time'])).'</div>
                          <div class="date specifications">'.$row['Date'].'</div>
                      </div>
                      <div class="req-final-status accepted">'.$row['Status'].'</div>
                  </div>';
                      }elseif($row['Status']== 'rejected'){
                        echo '<div class="result-cell">
                                                
                      <div class="acc-info"> <!--row-->
                          <img class="result-img" src="../images/'.$row['image'].'" alt="account image"> <!--column1-->
                          <div class="more-info">
                              <h5><i class="fa-solid fa-user"></i>'.$row['Firstname']. " "  .$row['Lastname'].'</h5>
                             
                          </div>     
                      </div>
                      
                      <div class="specifications-div">
                          <div class="language specifications">'.$row['Language'].'</div>
                          <div class="level specifications">'.$row['Level'].'</div>
                          <div class="duration specifications">'.$row['Duration'].' Minutes</div>
                          <div class="time specifications">'.date("h:i A", strtotime($row['Time'])).'</div>
                          <div class="date specifications">'.$row['Date'].'</div>
                      </div>
                      <div class="req-final-status rejected">'.$row['Status'].'</div>
                  </div>';
                  } 
                }}
                  else {
                      echo "No Previous Requests<br>" ;
                  }
                  ?>


                
    

         </main>

        
         
                <footer>
                    <footer>
                        <div class="main-content">
                          <div class="left box">
                            <h2>About us</h2>
                            <div class="content">
                              <p> Embark on a linguistic journey with LINGUIST. Connect with native speakers worldwide,
                                   hone your language skills through immersive experiences, and unlock new cultures from the comfort of your home.
                                   <a class="find-more" href="About_us_pageMain.html">Find more</a></p>
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
