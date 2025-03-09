<?php
session_start(); // Start a session (if needed)

// Include the database connection file
include("connection.php");

// Retrieve the form data from the $_POST superglobal array
$sessionID = isset($_POST["sessionID"]) ? $_POST["sessionID"] : '';
$text = isset($_POST["text"]) ? $_POST["text"] : '';
$rating = isset($_POST["rating"]) ? $_POST["rating"] : '';
$P_ID = isset($_POST["pid"]) ? $_POST["pid"] : '';

// Check if the session is set before accessing the user ID
if (isset($_SESSION['user_id'])) {
  $L_ID = $_SESSION['user_id'];

  // Prepare the SQL INSERT statement
  $sql = "INSERT INTO review (L_ID, starts, ReviewText, P_ID, sessionID) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    // Bind parameters to the prepared statement
    $stmt->bind_param("iisii", $L_ID, $rating, $text, $P_ID, $sessionID);
  
    // Execute the prepared statement
    if ($stmt->execute()) {
      echo "Feedback saved successfully!";
    } else {
      echo "Error saving feedback: " . $stmt->error;
    }

  } else {
    echo "Error preparing statement: " . $conn->error;
  }
} else {
  echo "User ID not set in session.";
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
