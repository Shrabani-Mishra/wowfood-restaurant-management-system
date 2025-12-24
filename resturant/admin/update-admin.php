<?php 
include("partials/menu.php");

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get admin details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $username = $row['username'];
    } else {
        $_SESSION['add'] = "<span style='color:red;'>Admin Not Found</span>";
        header("location:" . SITEURL . 'admin/manage-admin.php');
        exit();
    }
}
?>

<div class="wraper">
    <h1 class="choice-hover">Update Admin</h1>
    <form method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
// Update admin in DB
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE tbl_admin SET
                full_name='$full_name',
                username='$username'
            WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['add'] = "<span style='color:green;'>✅ Admin Updated Successfully</span>";
    } else {
        $_SESSION['add'] = "<span style='color:red;'>❌ Failed to Update Admin</span>";
    }
    header("location:" . SITEURL . 'admin/manage-admin.php');
}
include("partials/footer.php");
?>
