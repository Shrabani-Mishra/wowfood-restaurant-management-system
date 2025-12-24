<?php 
include('config/constants.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/admin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>
    <div class="login">
        <h2 class="text-center choice-hover">Login</h2>

        <!-- Show session messages -->
        <?php 
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['login-message'] ))//from login-chechkphp  session message
    {
        echo $_SESSION['login-message'] ;
        unset ($_SESSION['login-message'] );
    }
    ?>
        <br>

        <!-- Login form -->
        <form action="" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="Enter Username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>

</html>

<?php
// Process login after form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password =md5 ($_POST['password']);

    // 1. SQL to check user
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 2. Execute query
    $res = mysqli_query($conn, $sql);

    // 3. Count rows
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available → login success
        $_SESSION['login'] = "<div class='success'>Login Successful ✅</div>";
        $_SESSION['user'] = $username; // store username in session && checed the user is loged in

        // Redirect to dashboard
        header("location:" . SITEURL . "admin/");
        exit();
    } else {
        // User not available → login fail
        $_SESSION['login'] = "<div class='error text-center'>Invalid Username or Password ❌</div>";
        header("location:" . SITEURL . "admin/login.php");
        exit();
    }
}
?>