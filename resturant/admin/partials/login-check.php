<?php 
// Authorization - Access Control

// Start session if not started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // User is not logged in
    $_SESSION['login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    
    // Redirect to login page
    header("location:" . SITEURL . "admin/login.php");
    exit();
}
?>