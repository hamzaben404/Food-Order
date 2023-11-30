<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">

            <h1>Add Food</h1>

            <br><br>

            <?php 
            
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    echo "<br><br><br>";
                    unset($_SESSION['upload']);
                }
            
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Title Of Food">
                        </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" placeholder="Description Of The Food" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php

                                    $sql = "SELECT * FROM Tbl_category WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    } else
                                    {
                                        ?>
                                            <option value="0">No category Found</option>
                                         <?php
                                    }
                                

                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">NO
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">NO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                if(isset($_POST['submit']))
                {
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $category = mysqli_real_escape_string($conn, $_POST['category']);

                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    } else {
                        $featured = "No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    } else {
                        $active = "No";
                    }

                    if(isset($_FILES['image']['name'])){
                        //upload image
                        //to upload image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
    
                        if($image_name != ""){
    
                            //auto rename our image
                            //get the extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                            $tmp = explode('.', $image_name);
                            $ext = end($tmp);
    
                            //Rename the image
                            $image_name = "Food_name_".rand(000, 999).".".$ext; //e.g. food_category_920.jpg
    
                            $source_path = $_FILES['image']['tmp_name'];
                            
                            $destination_path = "../images/food/".$image_name;
    
                            //finally upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);
    
                            //check whether the image is uploaded or not
                            //and if the image is not uploaded then we will stop the process and redirect with err message
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class='err'>Failed to Upload image.</div>";
                                header('location:'.SITEURL.'admin/add_food.php');
                                die();
                            }
    
                        }
    
                    } else {
                        $image_name = "";
                    }

                    // echo "<br><br><br>";
                    // echo "image_name". $image_name ."<br>";
                    // echo "title".$title."<br>";
                    // echo "description".$description."<br>";
                    // echo "category".$category."<br>";
                    // echo "featured".$featured."<br>";
                    // echo "active".$active."<br>";
                    // echo "price".$price."<br>";

                    $sql2 = "INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`,`image_name`, `category_id`, `featured`, `active`) 
                            VALUES (NULL, '$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true){
                        $_SESSION['add'] = "<div class='success'>Food Added successfully</div>";
                        header('location:'.SITEURL.'admin/manage_food.php');
                    } else {
                        $_SESSION['add'] = "<div class='err'>Failed to added Food</div>";
                        header('location:'.SITEURL.'admin/manage_food.php');
                    }

                }

            ?>
        </div>
    </div>

<?php include('partials/footer.php') ?>