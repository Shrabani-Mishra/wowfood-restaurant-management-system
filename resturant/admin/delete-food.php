<?php

include('partials/menu.php');


// 1. Check if id and image_name are set
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove image file if exists
    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        if (file_exists($path)) {
            $remove = unlink($path);

            if (!$remove) {
                $_SESSION['delete'] = "<div class='error'>Failed to remove image file.</div>";
                header("Location: " . SITEURL . "admin/manage-food.php");
                exit();
            }
        }
    }

    // 3. Delete food from database
    $sql = "DELETE FROM `tbl-food` WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    // 4. Check if deletion successful
    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete food from database.</div>";
    }

    // Redirect back to manage-food
    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();

} else {
    // Redirect if id not set
    $_SESSION['delete'] = "<div class='error'>Unauthorized access.</div>";
    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();
}
?>