<?php
    if(isset($_POST['submit'])){
        $Username = $_POST['username'];
        $Pwd = $_POST['pwd'];
        require_once 'dbh.inc.php';
        require_once 'function.inc.php';
        if(empty($Username)){
            header("Location: ../../login.php?error=emptyinput");
            exit;
        }
        loginUser($conn, $Username, $Pwd);
        
    } else {
        header("Location: ../../login.php");
        exit;
    }