<?php
// Include constants for SITEURL
include('config/constants.php');

// 1. Start session
//session_start();

// 2. Destroy the session
session_destroy();

// 3. Redirect to login page
header('location:' . SITEURL . 'admin/login.php');
exit();
?>
