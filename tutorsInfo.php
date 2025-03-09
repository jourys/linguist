<?php

if (!isset($_SESSION['user_id'])) {
   
    header("Location: login.php");
    exit(); 
}


include("connection.php");

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM tutor WHERE ID = '$user_id';";
$result = mysqli_query($conn, $sql);
$tutorsSessionsQuery = "SELECT * FROM session WHERE T_id = '$user_id';";
// Execute the query
$tutorsSessionsResult = mysqli_query($conn, $tutorsSessionsQuery);


$totalHours = 0;
$totalStars =0;
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the name from the result set
    $row = mysqli_fetch_assoc($result);
    $firstname = $row['Firstname'];
    $lastname = $row['Lastname'];
    $email = $row['Email'];
    $phone = $row['PhoneNumber'];
    $bio = $row['bio'];
    $experience = $row['experience'];
    $eduction = $row['eduction'];
    $image=$row["image"];

} else {
    
    echo "<h1>Error: User not found</h1>";
}
//ALTER TABLE `session` ADD `Price` DOUBLE(10)

$totalEarnings=0;
if (mysqli_num_rows($tutorsSessionsResult) > 0) {
    
    while ($sessionRow = mysqli_fetch_assoc($tutorsSessionsResult)) {
        
        $totalHours += $sessionRow['Duration'] / 60;
        $totalEarnings += $sessionRow['Price'] ;
    }

}

$totalReviews =0;
$tutorReviewsQuery ="SELECT * FROM review WHERE P_ID  = '$user_id';";
$tutorReviewsResult = mysqli_query($conn, $tutorReviewsQuery);

if (mysqli_num_rows($tutorReviewsResult) > 0) {
   
    while ($ReviewsRow = mysqli_fetch_assoc($tutorReviewsResult)) {
        
        $totalStars += $ReviewsRow['starts'];
        $totalReviews++;
    }
    if ($totalReviews > 0) {
        $averageRating = $totalStars / $totalReviews;
    } else {
       
        $averageRating = 0; 
    }
}



function displayLanguages() {
    $user_id = $_SESSION['user_id'];
    include("connection.php");
    $tutorsLagsQuery ="SELECT * FROM tutor_languages WHERE P_ID = '$user_id'";
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
function getClosestDateRequests() {
    $user_id = $_SESSION['user_id'];
    include("connection.php");
    $sqlForClosestDate = "SELECT * FROM request WHERE Status='Pending' AND P_ID = '$user_id' ORDER BY Date ASC LIMIT 5;";
    $resultForClosestDate = mysqli_query($conn, $sqlForClosestDate);

    // Check if there are rows returned
    if(mysqli_num_rows($resultForClosestDate) > 0) {
        
        // Loop through the results and display each request
        while($row = mysqli_fetch_assoc($resultForClosestDate)) {

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

            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            echo '<img src="../images/'.$lImage.'" alt="profile Picture">';
            echo '<h5><strong>'.$learner_name.'</strong></h5>';
            echo '</div>';

            echo '<section class="incard-elements">';
            // Display request details getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="'.getFlagImage($row['Language']).'" alt="flag">'.$row['Language'].'</p>'; 
            echo '<p class="level">'. $row['Level']. '</p>'; 
            echo '<p class="Date">' . $row['Date'] . '</p>'; 
            echo '<p class="duration">'.$row['Duration'].' Minutes</p>'; 
            echo '</section>';
            
            echo '</div>';
        }
        
    } else {
        
        echo '<h2 class="light">No pending requests found.</h2>';
      
    }
}

// Function to retrieve all pending requests
function getAllPendingRequests($conn, $user_id) {
    $sqlForAllPending = "SELECT * FROM request WHERE Status='Pending' AND P_ID = '$user_id';";
    $resultForAllPending = mysqli_query($conn, $sqlForAllPending);

    // Check if there are rows returned
    if(mysqli_num_rows($resultForAllPending) > 0) {
          // Loop through the results and display each request
          while($row = mysqli_fetch_assoc($resultForAllPending)) {

            $learner_id = $row['L_ID'];
            $sqlLearner = "SELECT * FROM learner WHERE ID = '$learner_id'";
            $resultLearner = mysqli_query($conn, $sqlLearner);
            if(mysqli_num_rows($resultLearner) > 0) {
                $learnerData = mysqli_fetch_assoc($resultLearner);
                $learner_name = $learnerData['Firstname'] . ' ' . $learnerData['Lastname'];
                $lImage = $learnerData['image'];
            } else {
                $learner_name = "Unknown"; 
            }

            echo '<div class="request-card">';
            echo '<div class="learner-info">';
            echo '<img src="../images/'.$lImage.'" alt="profile Picture">';
            echo '<h5><strong>'.$learner_name.'</strong></h5>'; 
            echo '</div>';
            
            echo '<section class="incard-elements">';
            // Display request details getFlagImage($row['language']);
            echo '<p class="language"><img class="flag" src="'.getFlagImage($row['language']).'" alt="flag">'.$row['Language'].'</p>'; 
            echo '<p class="level">'. $row['Level']. '</p>'; 
            echo '<p class="Date">' . $row['Date'] . '</p>'; 
            echo '<p class="duration">'.$row['Duration'].' Minutes</p>'; 
            echo '</section>';
            
            echo '</div>';}
    } else {
        echo "No pending requests found.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
