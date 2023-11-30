<?php 

    // Start Session
    session_start();


    // Create Constants To Store Non Repeating Value
    define('SITEURL', 'http://localhost:8888/food_order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'food_order');

    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    $db_select = mysqli_select_db($conn, DB_NAME);

?>