<?php

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

// Connect to your database (assuming you have a function to establish a database connection)
include("connection.php");

// Fetch the name of the tutor based on the user ID stored in the session
$user_id = $_SESSION['user_id'];

// Query to fetch the name based on the user ID
$sql = "SELECT * FROM learner WHERE ID = '$user_id';";
$result = mysqli_query($conn, $sql);
$learnerSessionsQuery = "SELECT * FROM session WHERE L_id = '$user_id';";
$learnerReviewsQuery ="SELECT starts FROM review WHERE P_ID  = '$user_id';";
// Execute the query
$learnerSessionsResult = mysqli_query($conn, $learnerSessionsQuery);
$tutorReviewsResult = mysqli_query($conn, $learnerReviewsQuery);

$tutorsLagsQuery ="SELECT * FROM tutor_languages WHERE P_ID = '$user_id'";
$tutorLanguages=mysqli_query($conn, $tutorsLagsQuery);

$totalHours = 0;
$totalStars =0;
$totalReviews =0;
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the name from the result set
    $row = mysqli_fetch_assoc($result);
    $firstname = $row['Firstname'];
    $lastname = $row['Lastname'];
    $email = $row['email'];    
    $image=$row["image"];


} else {
    // Handle the case where the user ID is not found in the database
    echo "<h1>Error: User not found</h1>";
}


// Check if there are any sessions for the tutor
if (mysqli_num_rows($learnerSessionsResult) > 0) {
    // Loop through each session record
    while ($sessionRow = mysqli_fetch_assoc($learnerSessionsResult)) {
        // Add the duration of the session to the total hours
        $totalHours += $sessionRow['Duration'] / 60;
    }

}
?>
