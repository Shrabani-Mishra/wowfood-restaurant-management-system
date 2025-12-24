<?php
include("partials/menu.php");
?>

<?php
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>



<!-- Main content starts here -->
<section>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="choice-hover">Manage Orders</h1>
            <br />

            <table border="1" width="100%">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                // Query to get all orders
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);

                if($res){
                    $sn = 1;
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $food; ?></td>
                    <td>₹<?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td>₹<?php echo $total; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_contact; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_address; ?></td>
                    <td>
                        <a href="update-order.php?id=<?php echo $id; ?>" class="action-btn update-btn">Update Order</a>
                        <a href="delete-order.php?id=<?php echo $id; ?>" class="action-btn delete-btn">Delete Order</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='12'>No Orders Found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Main content ends here -->

<!-- Footer section -->
<?php
include("partials/footer.php");
?>