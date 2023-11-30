<?php include('partials/menu.php') ?>


<!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>

                <br><br>
                

                <?php

                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        echo "<br><br><br>";
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        echo "<br><br><br>";
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        echo "<br><br><br>";
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove'];
                        echo "<br><br><br>";
                        unset($_SESSION['failed-remove']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        echo "<br><br><br>";
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        echo "<br><br><br>";
                        unset($_SESSION['update']);
                    }


                ?>

                <a href="<?php echo SITEURL ;?>admin/add_food.php" class="btn-primary">Add Food</a>

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image-Name</th>
                        <th>Category_id</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    
                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title . " ";?></td>
                                    <td><?php echo $description . " ";?></td>
                                    <td><?php echo $price . " ";?></td>
                                    <td>
                                        <?php 
                                        
                                            if($image_name == "")
                                            {
                                                echo "<div class='err'>Image Not Added</div>";
                                            } else {
                                                ?> <img src="<?php echo SITEURL."images/food/". $image_name ?>" alt="" class="images"> <?php
                                            }
                                        
                                        ?>
                                    </td>
                                    <td><?php echo $category_id . " ";?></td>
                                    <td><?php echo $featured . " ";?></td>
                                    <td><?php echo $active . " ";?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id;?>" class="btn-primary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name ?>" class="btn-secondary">Delete Fodd</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr>
                                    <td colspan="6"><div class="err">No category Added.</div></td>
                                </tr>
                             <?php
                        }
                    
                    ?>
                    

                </table>
            </div>
        </div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>