<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        $sql = "DELETE FROM tbl_food WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            // echo $path;

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='err' >Faile to remove Food Image.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
                die(); //stop the process.
            }
        }

        if($res == true)
        {
            $_SESSION['delete'] = "<div class='success' >Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='err' >Failed to delete Food.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }

    } else {
        header('location:'.SITEURL.'admin/manage_food.php');
    }


?>