<?php include('partials-front/menu.php'); ?>

<?php
// Check whether food_id is set or not
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Get the food details from database
    $sql = "SELECT * FROM `tbl-food`  WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        // Food data found
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // Food not found — redirect to home page
        header('location:' . SITEURL);
        exit();
    }
} else {
    // Redirect to home page
    header('location:' . SITEURL);
    exit();
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">

            <fieldset>
                <legend>Selected Food</legend>


                <div class="food-menu-img">
                    <?php
                    //check weather the image are available or not
                    if ($image_name == "") {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                        ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                        class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>" />
                    <p class="food-price">₹<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>" />

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Shrabani Mishra" class="input-responsive"
                    required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 7319xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. shrabani@example.com" class="input-responsive"
                    required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
        <?php
        //Check weather the submit button is click or not
         if (isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty; // total price

            $order_date = date("Y-m-d H:i:s"); // order date
            $status = "Ordered"; // Ordered, On Delivery, Delivered, Cancelled

            $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

            // Save the order in database
            $sql2 = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
                     VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                // Order saved successfully
              $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully.</div>";
              header('location:' . SITEURL);

            } else {
                // Failed to save order
                $_SESSION['order'] = "<div class='error text-center'>Failed to order food. Try again later.</div>";
                header('location:' . SITEURL);
            }
        }
        
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>