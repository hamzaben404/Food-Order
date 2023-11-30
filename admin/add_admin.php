<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" autocomplete="none">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username" autocomplete="none">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password" autocomplete="none">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php') ?>

<?php 

    if(isset($_POST['submit'])){
        // echo "button clicked";

        //1. Get The Data From Form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));// Crypt Password;

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) 
                VALUES (NULL, '$full_name', '$username', '$password')
            ";

        //3. Executing Query And Saving Data into Database
        $res = mysqli_query($conn, $sql);

        //4. Check Whether The (Query is Executed) data is inserted or not and display appropriate message
        if($res == TRUE) {
            //Data Inserted
            // echo "Data Inserted";
            
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            // Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/manage_admin.php');

        } else {

            //Failed To Inserted Data
            // echo "Faile To Insert Data";

            // Create a session variable to display message
            $_SESSION['add'] = "<div class='err'>Admin Not Added</div>";
            header("location:".SITEURL.'admin/manage_admin.php');
        }

        
    } else {
        // echo "button not clicked";

    }

?>