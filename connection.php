<?php
    
    $servername ="localhost";
    $username="root";
    $password=" ";
    $dbname="cardholder";

    //$conn = mysqli_connect($servername,$username,$password,$dbname);
    $conn = mysqli_connect("127.0.0.1", "root", " ", "cardholder", 3308);

    if($conn)
    {
       // echo "connection ok";
    }
    else
    {
        echo "connection failed".mysqli_connect_error();
    }
?>