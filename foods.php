<?php include('partials-front/menu.php') ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL.'food-search.php' ?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <!-- GEt info from database table food -->
            <?php 
            
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
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
                                    
                                        if($image_name == ""){
                                            echo "<div class='err' >Image Not Found!!!</div>";
                                        } else {
                                            ?>
                                            <img src="<?php echo SITEURL.'images/food/'.$image_name; ?>" 
                                                alt="Chicke Hawain <?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4>Food Title</h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL.'order.php?food_id='.$id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                    echo "<div class='err' >Food don't found!!!</div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>
