<?php 

    //Authorization - Access Control
    //Check whether the user us logged in or not

    if(!isset($_SESSION['user'])){
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='err' >Please login to access admin Panel</div>";
        //Redirect to login Page
        header('location:'.SITEURL.'admin/login.php');
        
    }
?>