<?php 
include("partials/menu.php"); 
?>

<div class="main-content">
    <div class="wraper">
        <h1 class="choice-hover">Change Password</h1>
        <br><br>

        <?php 
        if (isset($_SESSION['pwd-msg'])) {
            echo $_SESSION['pwd-msg']; // show the message
            unset($_SESSION['pwd-msg']); // remove it after showing
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Current password" required></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="New password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="action-btn change-btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
// When form is submitted
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 1. Check if current password is correct
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if ($res == true && mysqli_num_rows($res) == 1) {
        // 2. Check new password == confirm password
        if ($new_password == $confirm_password) {
            // 3. Update password
            $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['pwd-msg'] = "<div class='success'>✅ Password Changed Successfully.</div>";
            } else {
                $_SESSION['pwd-msg'] = "<div class='error'>❌ Failed to Change Password.</div>";
            }
        } else {
            $_SESSION['pwd-msg'] = "<div class='error'>❌ New Password and Confirm Password do not match.</div>";
        }
    } else {
        $_SESSION['pwd-msg'] = "<div class='error'>❌ Current Password is Incorrect.</div>";
    }

    // Redirect back to manage-admin
    header("location:" . SITEURL . 'admin/update-password.php');
    exit();
}
?>

<?php include("partials/footer.php"); ?>
