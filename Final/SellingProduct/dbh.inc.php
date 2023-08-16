<?php
    $ServerName = "localhost";
    $UserNamedb = "root";
    $Password = "";
    $dbName = "auction";

    $conn = mysqli_connect($ServerName, $UserNamedb, $Password, $dbName);

    if(!$conn){
        die("Connection fail: ".mysqli_connect_error());
    }