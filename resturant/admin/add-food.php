<?php 
include('partials/menu.php'); 


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" required />
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"
                            placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" step="0.01" placeholder="Price of the food" required />
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            // Fetch all active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            if ($res && mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No" checked> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No" checked> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get form data safely
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = isset($_POST['category']) && $_POST['category'] != "" ? $_POST['category'] : 0;
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Handle image upload
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "Food_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_dir = "../images/food/";

                if (!is_dir($destination_dir)) {
                    mkdir($destination_dir, 0777, true);
                }

                $destination_path = $destination_dir . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                if (!$upload) {
                    echo "<div class='error'>Failed to upload image.</div>";
                    die();
                }
            } else {
                $image_name = "";
            }

            // Insert into database with backticks for table name
            $sql2 = "INSERT INTO `tbl-food` SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

           if ($res2) {
    // Set success message in session
    $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";

    // Redirect to manage-food.php
    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();
} else {
    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();
}

        }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>