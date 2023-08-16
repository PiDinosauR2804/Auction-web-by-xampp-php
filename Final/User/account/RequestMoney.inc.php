<?php
    session_start();
    if(isset($_POST['submit'])){
        $id = $_SESSION['id'];
        $amount = $_POST['request'];

        require_once 'dbh.inc.php';
        require_once 'function.inc.php';

        if(empty($amount)){
            header("Location: ../../Recharge.php?error=emptyinput");
            exit;
        }
        if(checkValidNumber($amount) !== false){
            header("Location: ../../Recharge.php?error=invalidNumber");
            exit;
        }
        $amount = intval($_POST['request']);
        requestMoney($id,$amount,$conn);

    } else {
        header("Location: ../../index.php?error=none");
        exit;
    }