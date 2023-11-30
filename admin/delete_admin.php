<?php 
    //Add Constants file
    include('../config/constants.php');

    //1. get the id of admin to be deleted
    $id = $_GET['id'];

    //2. Create Sql Query to delete Admin
    $sql  = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
        //Admin is deleted
        // echo "Admin deleted";
        // Create Session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL. 'admin/manage_admin.php');
    } else {
        //Failed to deleted 
        // echo "Admin Not Deleted";
        // Create Session Variable to display message
        $_SESSION['delete'] = "<div class='err'>Failed to delete admin</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL. 'admin/manage_admin.php');
    }

    //3. Redirect To Manage Admin Page With Message(Success/Err)

?>