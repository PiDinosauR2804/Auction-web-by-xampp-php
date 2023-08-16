<?php
    session_start();
    if(isset($_POST['submit'])){
        require_once '../User/account/dbh.inc.php';
        require_once 'function.inc.php';

        $ProductId = $_GET['ProductId'];
        $StartingPrice  = $_POST['StartingPrice'];
        $BuyOutPrice = $_POST['BuyOutPrice'];
        $EndsTime = $_POST['EndsTime'];

        $Products = GetProductsByOwnerId($conn,$_SESSION['id']);
        foreach($Products as $Product){
            if($Product['id'] == $ProductId){
                $PostProduct = $Product;
                break;
            }
        }
        if(empty($StartingPrice) || empty($BuyOutPrice) || empty($EndsTime)){
            header("Location: ../ResForSellFromCart.php?Id=$ProductId& error=emptyinput");
            exit;
        }
        if(checkValidPrice($StartingPrice, $BuyOutPrice) !== false){
            header("Location: ../ResForSellFromCart.php?Id=$ProductId& error=InvalidPrice");
            exit;
        }

        $StartingPrice = intval($_POST['StartingPrice']);
        $BuyOutPrice = intval($_POST['BuyOutPrice']);
        
        if(checkNotPositivePrice($StartingPrice, $BuyOutPrice) !== false){
            header("Location: ../ResForSellFromCart.php?error=YourInputNotPositive");
            exit;
        }

        if(CheckValidEndsTime($EndsTime) !== false){
            header("Location: ../ResForSellFromCart.php?Id=$ProductId& error=InvalidEndsTime");
            exit;
        }

        addProductFromCart($conn, $PostProduct['product_name'], $StartingPrice, $BuyOutPrice, $EndsTime, $PostProduct['image_url'], $PostProduct['owner_id']);
        deleteProductFromCart($conn, $ProductId);
        header("Location: ../auction.php?error=successed");
        exit;

    } else {
        header("Location: ../index.php");
        exit;
    }