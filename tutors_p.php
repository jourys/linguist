<?php
// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the form data
  $date = $_POST['date'];
  $duration = $_POST['duration'];

  // Validate and sanitize the input data

  // Insert the booking into the database
  // Example SQL query (you should modify this according to your database schema)
  $sql = "INSERT INTO sessions (date, duration) VALUES ('$date', '$duration')";
  
  if (mysqli_query($conn, $sql)) {
    echo "Session booked successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>
