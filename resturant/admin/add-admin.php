<?php include("partials/menu.php"); ?>
<div class="wraper">
    <h1 class="choice-hover">Add Admin</h1>

    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; // Display session message
        unset($_SESSION['add']); // Remove after displaying
    }
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="enter your name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="enter your username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="enter your password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include("partials/footer.php"); ?>

<?php
// Process the form
if (isset($_POST['submit'])) {

    // Get values
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validation: Check if any field is empty
    if ($full_name == "" || $username == "" || $password == "") {
        $_SESSION['add'] = "<span style='color:red;'>⚠️ All fields are required.</span>";
        header("location:" . SITEURL . 'admin/add-admin.php');
        exit();
    }

    // Encrypt password
    $password = md5($password);

    // Insert into database
    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['add'] = "<span style='color:green;'>✅ Admin Added Successfully</span>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = "<span style='color:red;'>❌ Failed to Add Admin</span>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
    }
}
?>
