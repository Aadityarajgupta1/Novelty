<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "novelty";

    //Creating database connection
    $con = mysqli_connect($host, $username, $password, $database);

    //Checking database connection
    if(!$con)
    {
        die("Connection failed: ". mysqli_connect_error());
    }
?>