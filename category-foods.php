<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php 
            
                if(isset($_GET['category_id']))
                {
                    $category_id = $_GET['category_id'];

                    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $category_title = $row['title'];
                }
            
            ?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            $sql2 = "SELECT * FROM tbl_food Where category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);
            
            while($row2 = mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    $category_id = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];

                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    if($image_name == "")
                                    {
                                        echo "<div>Image Not Found!!!</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL.'images/food/'.$image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title ?></h4>
                                <p class="food-price">$<?php echo $price ?></p>
                                <p class="food-detail">
                                    <?php echo $description ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL.'order.php?food_id='.$id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php') ?>
