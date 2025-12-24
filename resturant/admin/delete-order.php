<?php
// Include the menu / database connection
include("partials/menu.php");

// 1. Check if the ID is set in URL
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // 2. Delete order from database
    $sql = "DELETE FROM tbl_order WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    // 3. Check if delete was successful
    if($res){
        $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Order.</div>";
    }

    // 4. Redirect to manage-order page
    header('location: manage-order.php');
} else {
    // ID not provided
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
    header('location: manage-order.php');
}

?>