<?php
include("partials/menu.php")
?>
    <!-- main content start here-->
    <section>
        <div class="main-content">
            <div class="wraper">
                <h1 class="choice-hover">Manage Admin</h1>
                <br/>

<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];//display session msg
    unset($_SESSION['add']);//removing session msg
}
?><br><br>









            <!--Button to Add Admin-->
            <a href="add-admin.php" class="btn btn-primary">Add Admin</a>
                <table>
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
//Query to Get all admin
$sql = "SELECT * FROM tbl_admin";
//execute query
$res = mysqli_query($conn, $sql);

//check whether the query is executed or not
if ($res == TRUE) {
    //COUNT ROWS whether data exists in database
    $count = mysqli_num_rows($res); //function to get all the rows in database
    $sn = 1; // Serial number variable

    if ($count > 0) {
        //we have data in database
        while ($rows = mysqli_fetch_assoc($res)) {
            //Using while loop to get all the data from database
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];
            ?>
            <tr>
                <td><?php echo $sn++; ?>.</td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
     <td>
    <a href="update-admin.php?id=<?php echo $id; ?>" class="action-btn update-btn">Update Admin</a>
    <a href="delete-admin.php?id=<?php echo $id; ?>" class="action-btn delete-btn">Delete Admin</a>
    <a href="update-password.php?id=<?php echo $id; ?>" class="action-btn change-btn btn-primary">Change Password</a>
</td>


            </tr>
            <?php
        }
    } else {
        //no data found
        ?>
        <tr>
            <td colspan="4" style="color:red;">No Admins Found</td>
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
    <!-- main content end here-->
    <!--footer section-->
    <?php
   include("partials/footer.php");
   ?>