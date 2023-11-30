<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>

            <?php 
            
                //check whether the id is set or not
                if(isset($_GET['id'])){
                    //get the id and all other details
                    // echo "getting the data";
                    $id = $_GET['id'];
                    //Create sql query to get all other details
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";
                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    //count the rows to check whether the id is valid or not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                    } else {
                        //redirect to manage category with session message
                        $_SESSION['no-category-found'] = "<div class='err' >Category Not Found</div>";
                        header('location:'.SITEURL.'admin/manage_category.php');
                    }
                } else {
                    //redirect to manage category
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
            
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current image: </td>
                        <td>
                            <?php 
                            
                                if($current_image != ""){
                                    //display the image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                } else {
                                    echo "<div class='err'>Image Not Upload.</div>";
                                }
                            
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No") { echo "checked"; } ?>  type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes") { echo "checked"; } ?>  type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No") { echo "checked"; } ?>  type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="update category" class="btn-secondary" >
                        </td>
                    </tr>
                </table>

            </form>

            <?php 
            
                if(isset($_POST['submit'])){
                    // echo "clicked";
                    //1. get all the values from our form
                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                    $active = mysqli_real_escape_string($conn, $_POST['active']);

                    //2.updating new image if selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        //Check whether the image is available or not
                        if($image_name != ""){
                            //A. upload the new image

                            //auto rename our image
                            //get the extension of our image (jpg, png, gif, etc) e.g...
                            $tmp = explode('.', $image_name);
                            $ext = end($tmp);

                            //rename the image
                            $image_name = "Food_category_".rand(000, 999).'.'.$ext;

                            $src_path = $_FILES['image']['tmp_name'];
                            $dst_path = "../images/category/.$image_name";

                            //Finally upload the image
                            $upload = move_uploaded_file($src_path, $dst_path);

                            //check whether the image is upload or not
                            //and if the image is not upload them we will stop the process and redirect with err msg
                            if($upload == false){
                                $_SESSION['upload'] = "<div class='err' >Failed to upload image.</div>";
                                header('location:'.SITEURL.'admin/manage_category.php');
                                die();
                            }

                            //b. remove the current image
                            if($current_image != ""){
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                //check whether the image is removed or not
                                //if failed to remove then display msg and stop the process
                                if($remove == false){
                                    $_SESSION['failed-remove'] = "<div class='err' >Failed to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/manage_category.php');
                                }
                            }

                        } else {
                            $image_name = $current_image;
                        }
                    } else {
                        $image_name = $current_image;
                    }

                    //3. update the database
                    $sql2 = "UPDATE tbl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            WHERE id=$id;
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    //4. redirect to manage category with message
                    if($res2 == true){
                        //category updated
                        $_SESSION['update'] = "<div class='success' >Category updated successfully.</div>";
                        header('location:'.SITEURL.'admin/manage_category.php');
                    }else {
                        //failed to update category
                        $_SESSION['update'] = "<div class='err' >Failed to update category.</div>";
                        header('location:'.SITEURL.'admin/manage_category.php');
                    }
                }
            
            ?>
        </div>
    </div>

<?php include('partials/footer.php') ?>