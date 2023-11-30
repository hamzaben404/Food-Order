<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <?php 
            
                if(isset($_GET['food_id']))
                {
                    //GEt the food id adn details of the selected food
                    $food_id = $_GET['food_id'];
                    // echo $food_id;
                    
                    //get the info of the selected food
                    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count the rows
                    $count = mysqli_num_rows($res);
                    //check whether the data is available or not
                    if($count==1)
                    {
                        //we have data
                        //Get The data From Database
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                    } else {
                        // food not available
                        // redirect to home page
                        header('location:'.SITEURL);
                    }

                } else {
                    //redirect to homepage
                    header('location:'.SITEURL);
                }

            
            ?>

            <form action="#" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            if($image_name == "")
                            {
                                // image not available
                                echo "<div class='err' >Image Not Found!!!</div>";
                            } else {
                                ?>
                                    <img src="<?php echo SITEURL.'images/food/'.$image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Full Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Phone Number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Your Address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // get all the details from the form
                    $food = mysqli_real_escape_string($conn, $_POST['food']);//for security: The default character set
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

                    $total = $price * $qty; //total = price * qty

                    $order_date = date("Y-m-d"); //order date

                    $status = "ordered"; //ordered, on delivery

                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                    //save the order in Database
                    //create sql to save data
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // echo $sql2; die();

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query executed successfully or not
                    if($res2 == true)
                    {
                        //query executed and order saved
                        $_session['order'] = "<div class='success' >Food ordered successfully.</div>";
                        header('location:'.SITEURL.'index.php');
                    } else {
                        //failed to save order
                        $_session['order'] = "<div class='err' >Failed to order food!!!</div>";
                        header('location:'.SITEURL.'index.php');
                    }
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php') ?>
    