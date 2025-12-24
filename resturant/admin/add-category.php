<?php 
include('partials/menu.php'); 
// database connection & SITEURL
?>

<div class="maincontent">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>

        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title" required></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end -->

        <?php
        // Process the form when submitted
        if (isset($_POST['submit'])) {
            // 1. Get form values
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active   = isset($_POST['active']) ? $_POST['active'] : "No";

            // 2. Handle image upload
            $image_name = "";
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION); // fixed
                $image_name = "Category_" . rand(000,999) . "." . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if (!$upload) {
                    $_SESSION['add'] = "<div class='error'>Failed to upload image.</div>";
                    header("location:" . SITEURL . "admin/add-category.php");
                    die();
                }
            }

            // 3. Insert into database
            $sql = "INSERT INTO tbl_category SET 
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'";

            $res = mysqli_query($conn, $sql);

            // 4. Redirect with message
            if ($res == TRUE) {
                $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                header("location:" . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                header("location:" . SITEURL . "admin/add-category.php");
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>