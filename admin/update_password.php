<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <br><br>

        <?php
        
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }

        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter Current Pass...">
                    </td>
                </tr>
                <tr>
                    <td>New Password </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter New Pass...">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Pass...">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>    
        </form>


    </div>
</div>

<?php 

    //check whether the submit button is clicked on Not
    if(isset($_POST['submit'])){
        //echo "Clicked";

        //1. get the data from form
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $current_password = mysqli_real_escape_string($conn,md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));

        //2. Check whether the user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";

        // execute the query
        $res = mysqli_query($conn, $sql);

        if($res == true){
            // check data is available or not
            $count = mysqli_num_rows($res);

            if($count==1){

                //user exits and password can be changed
                // echo "user exist";

                // check the new password and confirm match or not
                if($new_password == $confirm_password){

                    // update the password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == TRUE) {

                        // display success message
                        //redirect to manage admin page with success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Change Successfully</div>";
                        // redirect the user
                        header('location:'.SITEURL.'admin/manage_admin.php');

                    } else {

                        //redirect to manage admin page with err message
                        $_SESSION['change-pwd'] = "<div class='err'>Failed To Change Password</div>";
                        // redirect the user
                        header('location:'.SITEURL.'admin/manage_admin.php');    

                    }

                } else {

                    // redirect to manage admin page with err message

                    
                    $_SESSION['pwd-not-match'] = "<div class='err'>Password did not match</div>";
                    //Redirect the user
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }


            } else {

                //user does not exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='err'>User Not Found</div>";
                //Redirect the user
                header('location:'.SITEURL.'admin/manage_admin.php');
            
            }
        }

    }


?>






<?php include('partials/footer.php') ?>