<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>
        <?php 
        
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                echo "<br><br><br>";
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                echo "<br><br><br>";
                unset($_SESSION['upload']);
            }

        ?>

        <!-- Add Category Form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category Form Ends -->

        <?php 
        
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                // echo "clicked";

                //1. get the value from category form
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                
                // for radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured'])){
                    //get the value from form
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No";
                }

                if(isset($_POST['active'])){
                    //get the value from form
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }
                // print_r($_FILES['image']);

                // die();
                // Array ( [name] => phooto.png 
                //         [type] => image/png 
                //         [tmp_name] => /Applications/MAMP/tmp/php/phppX08Ie 
                //         [error] => 0 
                //         [size] => 289288 
                //     )

                if(isset($_FILES['image']['name'])){
                    //upload image
                    //to upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){

                        //auto rename our image
                        //get the extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. food_category_920.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        
                        $destination_path = "../images/category/".$image_name;

                        //finaly upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with err message
                        if($upload==false){
                            //set message
                            $_SESSION['upload'] = "<div class='err'>Failed to Upload image.</div>";
                            header('location:'.SITEURL.'admin/add_category.php');
                            die();
                        }

                    }

                }

                //2. create sql query to insert category into database
                $sql = " INSERT INTO `tbl_category` 
                            (`id`, `title`, `image_name`, `featured`, `active`) 
                        VALUES
                            (NULL, '$title', '$image_name', '$featured', '$active')
                ";

                //3. Execute the query and save in database
                $res = mysqli_query($conn, $sql);

                //4. check whether the query executed or not and data added or not
                if($res==TRUE){
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else {
                    $_SESSION['add'] = "<div class='err'>Failed to Added Category</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
            }

        ?>
    </div>

</div>


<?php include('partials/footer.php') ?>