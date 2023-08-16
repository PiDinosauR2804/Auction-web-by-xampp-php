<?php

if(isset($_POST['submit'])){
    $decide = $_POST['submit'];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';
    
    if($decide == "accept"){
        acceptRequest($conn,$_GET['id']);
    }
    if($decide == "denied"){
        deleteRequest($conn,$_GET['id']);
    }

} else {
    header("Location: ../../index.php");
    exit;
}