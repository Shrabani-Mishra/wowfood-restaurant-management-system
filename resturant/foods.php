<?php include('partials-front/menu.php'); ?>

<!-- FOOD MENU Section Starts Here -->

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Query to get all active foods
        $sql = "SELECT * FROM `tbl-food` WHERE active='Yes' ORDER BY title ASC"; 
        $res = mysqli_query($conn, $sql);

        if($res){
            $count = mysqli_num_rows($res);

            if($count > 0){
                // Loop through all active foods
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
        ?>

        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php 
                if($image_name != "" && file_exists("images/food/" . $image_name)){ ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">
                <?php } else { ?>
                <div class="error">Image Not Available</div>
                <?php } ?>
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">₹<?php echo $price; ?></p>
                <p class="food-detail"><?php echo $description; ?></p>
                <br>
                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order
                    Now</a>
            </div>
        </div>

        <?php
                }
            } else {
                echo "<div class='error text-center'>No active foods available right now. Please check back later!</div>";
            }
        } else {
            echo "<div class='error text-center'>Failed to fetch food data.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php include('partials-front/footer.php'); ?>