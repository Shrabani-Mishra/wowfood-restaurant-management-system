<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="choice-hover">Update Order</h1>
        <br><br>

        <?php
        // 1. Get the order ID from URL
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            // 2. Fetch order details from database
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res && mysqli_num_rows($res) == 1){
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                // Order not found
                header('location: manage-order.php');
                exit();
            }
        } else {
            // ID not provided
            header('location: manage-order.php');
            exit();
        }
        ?>

        <!-- Update Form -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>₹<?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>" required></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On
                                Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered
                            </option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>" required></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="email" name="customer_email" value="<?php echo $customer_email; ?>" required></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea name="customer_address" cols="30" rows="5"
                            required><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // 3. Update order in database
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            $sql2 = "UPDATE tbl_order SET 
                        qty=$qty,
                        total=$total,
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                     WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);

            if($res2){
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
            }

            // Redirect to manage-order page
            header('location: manage-order.php');
        }
        ?>

    </div>
</div>

<?php
include("partials/footer.php");
?>