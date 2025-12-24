<?php
include('partials/menu.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove image if exists
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        if (file_exists($path)) {
            $remove = unlink($path);
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                die();
            }
        }
    }

    // Delete category from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    }

    header('location:' . SITEURL . 'admin/manage-category.php');
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>