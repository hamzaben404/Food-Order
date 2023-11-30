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
    <?php
                
                    if(isset($_SESSION['food-not-found'])){
                        echo "<br><br>";
                        echo $_SESSION['food-not-found'];
                        unset($_SESSION['food-not-found']);
                    }

                    if(isset($_SESSION['order'])){
                        echo "<br><br>";
                        echo $_SESSION['order'];
                        unset($_SESSION['order']);
                    }
                
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
                //get data of food set them here
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                $res = mysqli_query($conn, $sql);

                if($res == true){
                    // echo "data insert";
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            <a href="<?php echo SITEURL . 'category-foods.php?category_id='.$id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                
                                    if($image_name == ""){
                                        echo "<div class='err' >Image Not Found.</div>";
                                    } else {
                                        ?> 
                                            <img src="<?php echo SITEURL.'images/category/'.$image_name; ?>" 
                                            alt="<?php echo $title ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                            <?php
                            
                        }
                    } else {
                        echo "tbl_food is empty";
                    }

                }else {
                    // echo "data failed to insert";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>

   