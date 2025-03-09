<?php
include 'connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sessionID'])) {
    $sessionID = $_POST['sessionID'];

    // SQL to delete a session
    $sql = "DELETE FROM session WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $sessionID);

    if (mysqli_stmt_execute($stmt)) {
        echo "Session cancelled successfully.";
    } else {
        echo "Error cancelling session: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "No session ID provided.";
}//a
?>