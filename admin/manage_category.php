<?php include('partials/menu.php') ?>
<!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>
                
                <br /><br /><br /> 

                <?php 
        
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        echo "<br><br><br>";
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        echo "<br><br><br>";
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        echo "<br><br><br>";
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        echo "<br><br><br>";
                        unset($_SESSION['no-category-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        echo "<br><br><br>";
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        echo "<br><br><br>";
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        echo "<br><br><br>";
                        unset($_SESSION['failed-remove']);
                    }
                    
                ?>

                <!-- Button to add category -->
                <a href="<?php echo SITEURL ;?>admin/add_category.php" class="btn-primary">Add Category</a>

                <br /><br /><br /> 
                     
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image-Name</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php 

                        $sql = "SELECT * FROM tbl_category";

                        $res = mysqli_query($conn, $sql);

                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            
                            if($count>0) {
                                //we have a data
                                $sn = 1;
                                while($rows = mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];
                            
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++ . ". "; ?> </td>
                                            <td><?php echo $title; ?></td>
                                            <td>
                                                <?php 
                                                    if($image_name == ""){
                                                        echo "<div class='err'>Image Not Added.</div>";

                                                    } else {

                                                        ?>

                                                        <img src="<?php echo SITEURL; ?>images/category/<?php $image_name; ?>" width="100px" >
                                            
                                                        <?php
                                                    }
                                                
                                                ?>
                                            </td>
                                            <td><?php echo $featured; ?></td>
                                            <td><?php echo $active; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id;?>" class="btn-primary">Update Category</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name ?>" class="btn-secondary">Delete Category</a>
                                            </td>
                                        </tr>
                                    <?php

                                }
                            } else {
                                //we don't have a data
                                ?>
                                <tr>
                                    <td colspan="6"><div class="err">No category Added.</div></td>
                                </tr>
                                <?php
                            }
                        }
                        
                    ?>

                </table>
            </div>
        </div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>
