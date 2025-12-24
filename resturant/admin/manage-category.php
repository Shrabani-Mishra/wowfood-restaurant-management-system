<?php 
// Include menu
include("partials/menu.php"); 


?>

<!-- Main content start here -->
<section>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="choice-hover">Manage Category</h1>
            <br />

            <!-- Button to Add Category -->
            <a href="<?php echo SITEURL . 'admin/add-category.php'; ?>" class="btn btn-primary">Add Category</a>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                // Fetch categories from database
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1; // Serial number

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id         = $row['id'];
                            $title      = $row['title'];
                            $image_name = $row['image_name'];
                            $featured   = $row['featured'];
                            $active     = $row['active'];
                            ?>
                <tr>
                    <td><?php echo $sn++; ?>.</td>
                    <td><?php echo $title; ?></td>
                    <td>
                        <?php 
                                    if ($image_name != "") {
                                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                        <?php
                                    } else {
                                        echo "<div class='error'>No Image</div>";
                                    }
                                    ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"
                            class="action-btn update-btn">Update Category</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                            class="action-btn delete-btn">Delete Category</a>

                    </td>
                </tr>
                <?php
                        }
                    } else {
                        ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No categories added yet.</div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>

        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Main content end here -->

<!-- Footer Section -->
<?php include("partials/footer.php"); ?>