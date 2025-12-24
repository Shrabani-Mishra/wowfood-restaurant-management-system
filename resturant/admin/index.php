<?php 
include("partials/menu.php"); 
?>

<!-- Main Content Section Starts -->
<section>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="choice-hover">DASHBOARD</h1>
            <br>

            <?php 
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];  // Display login message
                unset($_SESSION['login']); // Remove after displaying once
            }
            ?>
            <br><br>

            <div class="col-4 text-center">
                <?php 
                // SQL Query to get total categories
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <?php 
                // SQL Query to get total foods
                $sql2 = "SELECT * FROM `tbl-food`";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">
                <?php 
                // SQL Query to get total orders
                $sql3 = "SELECT * FROM tbl_order";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                <?php 
                // SQL Query to get total revenue (Delivered Orders only)
                $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                $res4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($res4);
                $total_revenue = $row4['Total'];
                ?>
                <h1>₹<?php echo $total_revenue ? $total_revenue : 0; ?></h1>
                <br />
                Revenue Generated
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!-- Main Content Section Ends -->

<?php include("partials/footer.php"); ?>