<?php
    session_start();
    
    if(isset($_POST['submit'])){

        require_once '../User/account/dbh.inc.php';
        require_once 'function.inc.php';
        require_once '../User/account/function.inc.php';

        $CurrentPay = $_POST['CurrentPay'];
        $product = getProductById($_GET['id'], $conn); 
        $productId = $_GET['id'];
        $currentUserId = $_SESSION['id'];

        if(empty($CurrentPay)){
            header("Location: ../Details.php?Id=$productId&error=emptyInput");
            exit;
        }
        if(checkValidPrice($CurrentPay, $CurrentPay) !== false){
            header("Location: ../Details.php?Id=$productId&error=InvalidPrice");
            exit;
        }

        $CurrentPay = intval($CurrentPay);

        if(checkNotPositivePrice($CurrentPay, $CurrentPay) !== false){
            header("Location: ../Details.php?Id=$productId&error=YourInputNotPositive");
            exit;
        }
        
        $UserWallet = getWaller($_SESSION['id'],$conn);

        if($CurrentPay > $UserWallet['wallet']){
            header("Location: ../Details.php?Id=$productId&error=NotEnough");
            exit;
        }
        if($CurrentPay < $product['current_pay'] || $CurrentPay < $product['starting_price']){
            header("Location: ../Details.php?Id=$productId&error=TooLow");
            exit;
        }
        if($CurrentPay >= $product['buy_out_price']){
            
            buyProduct($conn,$currentUserId , $product['id'], $product['product_name'], $CurrentPay, $product['image_url']);
            deleteProduct($conn, $product['id']);
            payup($conn, $currentUserId, $CurrentPay);
            receiveMoney($conn, $product['owner_id'], $CurrentPay);
            header("Location: ../auction.php?error=success");
            exit;
        } else {
            $CustomerId = $_SESSION['id'];
            $sql = "UPDATE products SET current_pay = '$CurrentPay', next_owner_id = '$CustomerId' WHERE id = '$productId';";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                // Xử lý lỗi truy vấn
                die("Truy vấn bị lỗi: " . mysqli_error($conn));
            }
            header("Location: ../auction.php?error=none");
            exit;
        }

    } else {
        header("Location: ../index.php");
        exit;
    }