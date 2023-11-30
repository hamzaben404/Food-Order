<?php include('partials/menu.php') ?>
<!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>

                <br><br>
                <?php 
                
                    if(isset($_SESSION['update-order']))
                    {
                        echo $_SESSION['update-order'];
                        unset($_SESSION['update-order']);
                        echo "<br><br>";
                    }
                
                ?>

                <a href="<?php echo SITEURL ;?>admin/add_food.php" class="btn-primary">Add Food</a>

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Status</th>
                        <th>Customer_name</th>
                        <th>Customer_contact</th>
                        <th>Customer_email</th>
                        <th>Customer_address</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
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
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $food . " ";?></td>
                                    <td><?php echo $price . " ";?></td>
                                    <td><?php echo $qty . " ";?></td>
                                    <td><?php echo $total . " ";?></td>
                                    <td><?php echo $order_date . " ";?></td>
                                    <td>
                                        <?php 
                                            // ordered, on delivery, delivered, cancelled
                                            if($status == "Ordered")
                                            {
                                                echo "<label>$status</label>";

                                            } elseif($status=="On Delivery") {
                                                echo "<label style='color: orange;'>$status</label>";

                                            } elseif($status=="Delivered") {
                                                echo "<label style='color: green;'>$status</label>";
                                                
                                            } elseif($status=="Cancelled") {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $customer_name . " ";?></td>
                                    <td><?php echo $customer_contact . " ";?></td>
                                    <td><?php echo $customer_email . " ";?></td>
                                    <td><?php echo $customer_address . " ";?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id;?>" class="btn-primary">Update Order</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_order.php?id=<?php echo $id;?>&image_name=<?php echo $image_name ?>" class="btn-secondary">Delete Order</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr>
                                    <td colspan="12"><div class="err">Order Not Available.</div></td>
                                </tr>
                             <?php
                        }
                    
                    ?>
                    

                </table>
            </div>
        </div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>
