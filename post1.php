<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    // User is logged in, fetch user data from the session
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];
    $userSurname = $_SESSION['userSurname'];
    header("Location: post.php?id=$userID"); 
}
    /* Display user data
    echo "Logged in as: $userName $userSurname";
} else {
    echo "Not logged in"; // You can customize this message as needed
}*/
?>

