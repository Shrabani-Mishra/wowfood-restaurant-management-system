<?php
include('partials/menu.php');

// Check if food ID is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch food details
    $sql = "SELECT * FROM `tbl-food` WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $food = mysqli_fetch_assoc($res);
        $title = $food['title'];
        $description = $food['description'];
        $price = $food['price'];
        $current_image = $food['image_name'];
        $current_category = $food['category_id'];
        $featured = $food['featured'];
        $active = $food['active'];
    } else {
        $_SESSION['update'] = "<div class='error'>Food not found.</div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
        exit();
    }
} else {
    header("Location:" . SITEURL . "admin/manage-food.php");
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" step="0.01" value="<?php echo $price; ?>" required></td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            echo "<img src='" . SITEURL . "images/food/$current_image' width='100px'>";
                        } else {
                            echo "Image not added";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" required>
                            <option value="">--Select Category--</option>
                            <?php
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res2 = mysqli_query($conn, $sql2);
                            if ($res2) {
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    $selected = ($current_category == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['title'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured=="Yes") echo "checked"; ?>>
                        Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured=="No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active=="Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($active=="No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Handle form submission
        if (isset($_POST['submit'])) {
            $id = intval($_POST['id']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = floatval($_POST['price']);
            $category = intval($_POST['category']);
            $featured = $_POST['featured'] ?? "No";
            $active = $_POST['active'] ?? "No";
            $current_image = $_POST['current_image'];

            // Handle new image
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_" . rand(000,999) . "." . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_dir = "../images/food/";
                if (!is_dir($destination_dir)) mkdir($destination_dir, 0777, true);
                $destination_path = $destination_dir . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload) {
                    if ($current_image != "" && file_exists("../images/food/$current_image")) {
                        unlink("../images/food/$current_image");
                    }
                } else {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header("Location:" . SITEURL . "admin/manage-food.php");
                    exit();
                }
            } else {
                $image_name = $current_image;
            }

            // Update database
            $sql_update = "UPDATE `tbl-food` SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                WHERE id=$id
            ";

            $res = mysqli_query($conn, $sql_update);

            if ($res) {
                $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
            }

            header("Location:" . SITEURL . "admin/manage-food.php");
            exit();
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>