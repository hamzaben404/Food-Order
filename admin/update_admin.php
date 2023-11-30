
<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
        
            //1. Get The Id Of Selected Admin
            $id = $_GET['id'];

            //2. Create SQL Query to Get The Details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // Execute The Query
            $res = mysqli_query($conn, $sql);

            // Check Whether The Query Is Executed Or Not
            if($res==TRUE){
                // Check Whether The Data is available or not
                $count = mysqli_num_rows($res);

                // Check Whether we have admin data or not
                if($count==1){
                    // Get The Details
                    // Echo "Admin Available";
                    $row  = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
            }
            else
            {
                // Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage_admin.php');
            }

        ?>

        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>" autocomplete="none">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>" autocomplete="none">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));// Crypt Password;

        // Get The id
        $id = $_GET['id'];

        //2. SQL Query to save the data into database
        $sql = " UPDATE `tbl_admin` SET `full_name` = '$full_name', 
                `username` = '$username', 
                `password` = '$password' 
                WHERE `tbl_admin`.`id` = $id
        ";

        //3. Executing Query And Saving Data into Database
        $res = mysqli_query($conn, $sql);

        //4. Check Whether The (Query is Executed) data is inserted or not and display appropriate message
        if($res == TRUE) {
            //Data Inserted
            // echo "Data Inserted";
            
            // Create a session variable to display message
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            // Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/manage_admin.php');

        } else {

            //Failed To Inserted Data
            // echo "Faile To Insert Data";

            // Create a session variable to display message
            $_SESSION['update'] = "<div class='err'>Admin Not Updated</div>";
            header("location:".SITEURL.'admin/manage_admin.php');
        }

        
    } else {
        // echo "button not clicked";

    }

?>