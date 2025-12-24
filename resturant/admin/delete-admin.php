
<?php include("config/constants.php");


//Get the id of Admin to Deleted

if (isset($_GET['id'])) {
    $id = $_GET['id'];//get id
//create SQL query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
//execution
    $res = mysqli_query($conn, $sql);
//redirect to manage Admin page with message(sucess/error)

    if ($res == TRUE) {
        $_SESSION['delete'] = "<span style='color:green;'>✅ Admin Deleted Successfully</span>";
    } else {
        $_SESSION['delete'] = "<span style='color:red;'>❌ Failed to Delete Admin</span>";
    }
    header("location:" . SITEURL . 'admin/manage-admin.php');//redirect the page
}
?>
