<?php

// if (!isset($_SESSION['user_id'])) {
//     // Redirect the user to the login page
//     header("Location: login.php");
//     exit(); // Stop further execution
// }

// include("connection.php");

// $user_id = $_SESSION['user_id'];


// $sql = "SELECT * FROM request WHERE  P_ID='$user_id' ";
// $result = mysqli_query($conn, $sql);

// // Check if there are any rows returned
// if (mysqli_num_rows($result) > 0) {
//     // Initialize an array to store requested times
//     $requestedTimes = array();
  

//   while ($row = mysqli_fetch_assoc($result)) {

//     $requestedData[] = array('date' => $row['Date'], 'time' => $row['Time']);
// }

//     // Convert the array to JSON format and echo it
//     echo json_encode($requestedTimes);
// } else {
//     // If no rows are returned, echo an empty array
//     echo json_encode(array());
// }


// mysqli_close($conn);





// Include your database connection file
include 'connection.php';

// Fetch available dates from the database
$sql = "SELECT DISTINCT Date FROM available_times WHERE availability = 1";
$result = mysqli_query($conn, $sql);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Initialize an array to store available dates
    $availableDates = array();

    // Fetch data and store available dates in the array
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the date to the availableDates array
        $availableDates[] = $row['Date'];
    }

    // Convert the array to JSON format and echo it
    echo json_encode($availableDates);
} else {
    // If no rows are returned, echo an empty array
    echo json_encode(array());
}

// Close the database connection
mysqli_close($conn);



?>
