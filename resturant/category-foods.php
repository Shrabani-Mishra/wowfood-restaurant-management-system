<?php include('partials-front/menu.php'); ?>

<?php
// Check whether category_id is passed or not
if (isset($_GET['category_id'])) {
    // Get and sanitize category_id
    $category_id = (int)$_GET['category_id'];

    // Get the category title based on category_id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);

    // Check if category exists
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } else {
        // Category not found — redirect to home
        header("location:" . SITEURL);
        exit();
    }
} else {
    // category_id not passed — redirect to home
    header("location:" . SITEURL);
    exit();
}
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Create SQL Query to get foods based on selected category
        $sql2 = "SELECT * FROM `tbl-food` WHERE category_id=$category_id";

        $res2 = mysqli_query($conn, $sql2);

        // Count the rows
        $count2 = mysqli_num_rows($res2);

        // Check whether food is available or not
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $title = $row2['title'];
                 $id = $row2['id'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">
                <?php
                        }
                        ?>
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">₹<?php echo $price; ?></p>
                <p class="food-detail"><?php echo $description; ?></p>
                <br>
                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">
                    Order Now
                </a>
            </div>
            <?php
            }
        } else {
            echo "<div class='error text-center'>Food not Available</div>";
        }
        ?>

            <div class="clearfix"></div>
        </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials-front/footer.php'); ?>