<?php include('partials/menu.php') ?>
        
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br>
                
                <?php 
                
                    if(isset($_SESSION['admin-exist'])){
                        echo $_SESSION['admin-exist'];
                        echo "<br><br><br>";
                        unset($_SESSION['admin-exist']);
                    }
                
                ?>

                <div class="col-4 text-center">

                    <?php                   
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            $nbCategory = $count;
                        } else {
                            $nbCategory = "<div class='err' >No Category Added.</div>";
                        }
                    ?>

                    <h1><?php echo $nbCategory ?></h1>
                    Categories
                </div>
                <div class="col-4 text-center">
                    
                    <?php 
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                        if($count2>0)
                        {
                            $nbFood = $count2;
                        } else {
                            $nbCategory = "<div class='err' >No Food Exist.</div>";
                        }
                    ?>
                    <h1><?php echo $nbFood ?></h1>
                    Foods
                </div>
                <div class="col-4 text-center">

                    <?php 
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res2);
                        if($count3>0)
                        {
                            $nbOrder = $count3;
                        } else {
                            $nbCategory = "<div class='err' >No Order Exist.</div>";
                        }
                    ?>
                    <h1><?php echo $nbCategory ?></h1>
                    Total Orders
                </div>
                <div class="col-4 text-center">

                    <?php 
                        //create sql query to get total revenue generated
                        // aggregate function in sql
                        $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status='Delivered'";
                        // execute the query
                        $res4 = mysqli_query($conn, $sql4);
                        //get the value
                        $row4 = mysqli_fetch_assoc($res4);
                        //get the total revenue
                        $nbRevenue = $row4['total'];
                    ?>
                    <h1>$<?php echo $nbRevenue; ?></h1>
                    Revenue Generated
                </div>

                <div class="clearfix text-center">

                </div>
            </div>
        </div>
        <!-- Main Content Section End -->

<?php include('partials/footer.php') ?>