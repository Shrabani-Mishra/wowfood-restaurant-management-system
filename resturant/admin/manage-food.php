<?php

include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>

        <!-- Display session messages -->
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br>

        <!-- Button to add food -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn btn-primary">Add Food</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // Fetch all foods with category
            $sql = "SELECT f.*, c.title AS category_name 
                    FROM `tbl-food` f 
                    LEFT JOIN tbl_category c ON f.category_id = c.id";
            $res = mysqli_query($conn, $sql);

            $sn = 1; // Serial number

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $category_name = $row['category_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $price; ?></td>
                <td>
                    <?php
                            if ($image_name != "") {
                                echo "<img src='" . SITEURL . "images/food/$image_name' width='100px' />";
                            } else {
                                echo "<div class='error'>No Image</div>";
                            }
                            ?>
                </td>
                <td><?php echo $category_name; ?></td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                        class="btn btn-secondary">Update</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                }
            } else {
                // No food added yet
                ?>
            <tr>
                <td colspan="8">
                    <div class="error">No Food Added Yet.</div>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>