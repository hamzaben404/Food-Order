<!-- get $conn -->
<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body class="bodyLogin">

        <div class="login text-center">
            <h1 class="text-center">Login</h1>

            <br><br>
            <?php 
        
                if(isset($_SESSION['admin-exist'])){
                    echo $_SESSION['admin-exist'];
                    echo "<br><br><br>";
                    unset($_SESSION['admin-exist']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    echo "<br><br><br>";
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <!-- login form starts here -->
            <form action="" method="POST">
                Username: <br> <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                Password: <br> <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" placeholder="Enter Username">
                <br><br>
            </form>
            <!-- login form end here -->


            <p class="text-center">Created By - <a href="www.hamzabenatmane.com">Hamza Benatmane</a></p>
        </div>
    </body>
</html>

<?php 

    if(isset($_POST['submit'])){

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        echo $password;

        // get the row where is all username in database
        $sql = " SELECT * FROM tbl_admin 
                            WHERE username='$username' 
                            AND   password='$password'
        ";
        // echo $sql;

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
            
            $count = mysqli_num_rows($res);
            
            if($count == 1) {
                // admin exist 
                $_SESSION['admin-exist'] = "<div class='success'>Welcome Back $username </div>";
                $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it
                // Redirect
                header("location:".SITEURL.'admin');

            } else {
                // admin doesn't exist
                $_SESSION['admin-exist'] = "<div class='err'>Sorry $username , Don't Found Admin</div>";
                // Redirect
                header('location:'.SITEURL.'admin/login.php');
            }

        }

    } else {
        // some err
    }

?>