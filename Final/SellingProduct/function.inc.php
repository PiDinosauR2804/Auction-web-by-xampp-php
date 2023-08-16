<?php

    function EmptyInputSignup($name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage)
    {
        if(empty($name) || empty($StartingPrice) || empty($BuyOutPrice) || empty($EndsTime) || empty($URLImage)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkValidPrice($StartingPrice, $BuyOutPrice)
    {
        if(!filter_var($StartingPrice, FILTER_VALIDATE_INT) || !filter_var($BuyOutPrice, FILTER_VALIDATE_INT)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkNotPositivePrice($StartingPrice, $BuyOutPrice)
    {
        if($StartingPrice <=0 || $BuyOutPrice <= 0){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkValidEndsTime($EndsTime)
    {
        $format = "Y-m-d\TH:i";
        $dateTime = DateTime::createFromFormat($format, $EndsTime);

        if($dateTime !== false && $dateTime->format($format) === $EndsTime){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // Check if existed product name in auction
    function checkNameExisted($conn, $Name)
    {
        $sql = "SELECT * FROM products WHERE product_name = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../ResForSell.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $Name);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    function createProduct($conn, $name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage, $OwnerId)
    {
        $sql = "INSERT INTO products (owner_id, product_name, starting_price, buy_out_price, ends_time, image_url, current_pay) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../ResForSell.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssss",$OwnerId, $name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage, $StartingPrice);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../auction.php?error=successed");
        exit();
    }

    function addProductFromCart($conn, $name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage, $OwnerId)
    {
        $sql = "INSERT INTO products (owner_id, product_name, starting_price, buy_out_price, ends_time, image_url, current_pay) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../ResForSell.php?error=stmtfailed");
            exit();
        }
        $currentpay = 0;
        mysqli_stmt_bind_param($stmt,"sssssss",$OwnerId, $name, $StartingPrice, $BuyOutPrice, $EndsTime, $URLImage, $currentpay);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function getProducts($conn)
    {
        $sql = "SELECT id, product_name, starting_price, buy_out_price, ends_time, image_url, current_pay, owner_id, next_owner_id  FROM products;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $product = [];
        while( $row = mysqli_fetch_assoc($result)){
            $product[] = $row;
        }
        return $product;
    }

    function getProductById($id, $conn)
    {
        $Products = GetProducts($conn);
        foreach ($Products as $product):
            if($product['id'] == $id){
                return $product;
            }
        endforeach;
    }

    function getProductByIdInCart( $conn, $id)
    {
        $sql = "SELECT * FROM productincart WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
            exit();
        }  
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    function EmptyInputPay($CurrentPay)
    {
        if(empty($CurrentPay) ){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function buyProduct($conn, $OwnerId, $ProductId, $ProductName, $PayValue, $image_url)
    {
        $sql = "INSERT INTO productincart (owner_id, id, product_name, pay_value, image_url) VALUES ('$OwnerId', '$ProductId', '$ProductName', '$PayValue', '$image_url');";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
            exit();
        }
    }

    function deleteProduct($conn, $id)
    {
        $sql = "DELETE FROM products WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
            exit();
        }        
    }

    function getProductsByOwnerId($conn,$id)
    {
        $sql = "SELECT * FROM productincart WhERE owner_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $product = [];
        while( $row = mysqli_fetch_assoc($result)){
            $product[] = $row;
        }
        return $product;
    }

    function countRemainTime($conn, $id)
    {
        $sql = "SELECT * FROM products WhERE id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $result = mysqli_fetch_assoc($result);
        $time = $result['ends_time'];
        $currentDateTime = new DateTime();
        $currentDateTime->add(new DateInterval('PT5H'));
        $timestampDateTime = new DateTime($time);        
        $diff = $currentDateTime->diff($timestampDateTime);
        $Remain = $diff->format('%d days, %H hours, %i minutes');
        return $Remain;
    }

    function checkWheatherEnds($conn, $id)
    {
        $sql = "SELECT * FROM products WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $result = mysqli_fetch_assoc($result);
        $time = $result['ends_time'];
        $currentDateTime = new DateTime();
        $currentDateTime->add(new DateInterval('PT5H'));
        $timestampDateTime = new DateTime($time);
        return $currentDateTime < $timestampDateTime;
    }
// Hiển thị
    function showEndsTime($conn, $id)
    {
        if(checkWheatherEnds($conn, $id)){
            $string = CountRemainTime($conn, $id);
        } else {
            $string = "Time has ended";
        }
        return $string;
    }

    function deleteProductFromCart($conn, $ProductId)
    {
        $sql = "DELETE FROM productincart WHERE id = $ProductId";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
            exit();
        }      
    }

