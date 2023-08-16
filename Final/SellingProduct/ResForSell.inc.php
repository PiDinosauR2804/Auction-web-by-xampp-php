<?php
    session_start();
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $OwnerId = $_SESSION['usersId'];
        $StartingPrice  = $_POST['StartingPrice'];
        $BuyOutPrice = $_POST['BuyOutPrice'];
        $EndsTime = $_POST['EndsTime'];
        $URLImage = $_POST['URLImage'];

        require_once '../User/account/dbh.inc.php';
        require_once 'function.inc.php';

        if(empty($name) || empty($StartingPrice) || empty($BuyOutPrice) || empty($EndsTime) || empty($URLImage)){
            header("Location: ../ResForSell.php?error=emptyinput");
            exit;
        }
        if(checkValidPrice($StartingPrice, $BuyOutPrice) !== false){
            header("Location: ../ResForSell.php?error=InvalidPrice");
            exit;
        }

        $StartingPrice = intval($_POST['StartingPrice']);
        $BuyOutPrice = intval($_POST['BuyOutPrice']);

        if(checkNotPositivePrice($StartingPrice, $BuyOutPrice) !== false){
            header("Location: ../ResForSell.php?error=YourInputNotPositive");
            exit;
        }
        if(CheckValidEndsTime($EndsTime) !== false){
            header("Location: ../ResForSell.php?error=InvalidEndsTime");
            exit;
        }
        if(checkNameExisted($conn, $name) !== false){
            header("Location: ../ResForSell.php?error=NameExist");
            exit;
        }
        createProduct($conn, $name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage, $OwnerId);
        
    } else {
        header("Location: ../index.php");
        exit;
    }