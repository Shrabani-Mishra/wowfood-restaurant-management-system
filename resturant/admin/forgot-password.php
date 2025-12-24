<?php 
include("partials/menu.php"); 
?>

<div class="wraper">
    <a href="update-password.php"><h1 class="choice-hover">Forgot Password</h1></a>
    <br>

    <?php 
    if(isset($_SESSION['forgot-msg'])){
        echo $_SESSION['forgot-msg'];
        unset($_SESSION['forgot-msg']);
    }
    ?>

    <form method="POST">
        <table class="tbl-30">
            <tr>
                <td>Enter Your Username:</td>
                <td><input type="text" name="username" placeholder="Enter your username" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="submit" name="submit" value="Reset Password" class="btn-primary">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    // Check if username exists
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        // Generate new random password
        $new_pass = substr(md5(time()), 0, 8);
        $enc_pass = md5($new_pass);

        // Update password in DB
        $sql2 = "UPDATE tbl_admin SET password='$enc_pass' WHERE username='$username'";
        $res2 = mysqli_query($conn, $sql2);

        if($res2){
            $_SESSION['forgot-msg'] = "<div class='success-msg'>
                Your new password is: <b>$new_pass</b> ✅<br>
                Please login and change it.
            </div>";
            header("location: forgot-password.php");
            exit();
        } else {
            $_SESSION['forgot-msg'] = "<div class='error-msg'>Failed to reset password ❌</div>";
            header("location: forgot-password.php");
            exit();
        }
    } else {
        $_SESSION['forgot-msg'] = "<div class='error-msg'>Username not found ❌</div>";
        header("location: forgot-password.php");
        exit();
    }
}
?>

<?php include("partials/footer.php"); ?>
