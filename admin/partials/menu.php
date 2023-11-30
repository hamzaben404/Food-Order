<?php 

    include('../config/constants.php'); 
    include('login_check.php');

?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage_admin.php">Admin</a></li>
                    <li><a href="manage_category.php">Category</a></li>
                    <li><a href="manage_food.php">Food</a></li>
                    <li><a href="manage_order.php">Order</a></li>
                    <li><a href="logout.php">LogOut</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section End -->