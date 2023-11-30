<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php 
        
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                // EXecute query
                $res = mysqli_query($conn, $sql);
                
                $row = mysqli_fetch_assoc($res);

                // get all info about the order
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
            } else {
                // redirect to manage order page
                header('location:'.SITEURL.'admin/mange_order.php');
            }

        ?>

        <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Food Name: </td>
                        <td>
                            <?php echo $food; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            $<?php echo $price; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty: </td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Total: </td>
                        <td>
                            $<?php echo $total; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status: </td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){ echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="On Delivery"){ echo "selected";} ?> value="On Delivery">On Delivery</option>
                                <option <?php if($status=="Delivered"){ echo "selected";} ?> value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancelled"){ echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer-name: </td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer-contact: </td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer-Email: </td>
                        <td>
                            <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer-Address: </td>
                        <td>
                            <textarea name="customer_address" cols="30" rows="5" ><?php echo $customer_address ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="price" value="<?php echo $price ?>">
                            <input type="submit" name="submit" value="update food" class="btn-secondary">
                        </td>
                    </tr>
                </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                $id = mysqli_real_escape_string($conn, $_POST['id']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $qty = mysqli_real_escape_string($conn, $_POST['qty']);
                $total = $price * $qty;
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

                //write sql command
                $sql2 = "UPDATE tbl_order SET
                    qty = '$qty',
                    total = '$total',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'  

                    WHERE id=$id 
                ";

                // echo $sql2; die();

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['update-order'] = "<div class='success' >Order Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                } else {
                    $_SESSION['update-order'] = "<div class='err' >Failed To Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }

            }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>