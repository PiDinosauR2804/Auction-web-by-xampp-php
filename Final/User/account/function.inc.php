<?php
    function getUserById($conn, $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id;";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
            exit();
        }  
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    function checkValidNumber($number)
    {
        if(!filter_var($number, FILTER_VALIDATE_INT) ){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkInvalidUserName($username)
    {
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
    function checkInvalidEmail($email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkIfPwdMatch($Pwd, $RepeatPwd)
    {
        if($Pwd !== $RepeatPwd){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function checkValidatePassword($password) 
    {
        if (strlen($password) < 8) {
            return true;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return true;
        }
        return false;
    }

    function checkUsernameExisted($conn, $username, $email)
    {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$username, $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if( $row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $user_name, $username, $email, $Pwd)
    {
        $sql = "INSERT INTO users (user_name, email, username, user_password) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../signup.php?error=stmtfailed");
            exit();
        }
        $PwdHashing = password_hash($Pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssss",$user_name, $email, $username, $PwdHashing);
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);
        // Create money in bag
        $NewUser = checkUsernameExisted($conn, $username, $email);
        $id = $NewUser["id"];
        $request = 0;
        $wallet = 0;
        $sql1 = "INSERT INTO moneymanager (user_id, username, request, wallet) VALUES ('$id', '$username', '$request', '$wallet');";
        $result = mysqli_query($conn, $sql1);
        if (!$result) { 
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        header("Location: ../../signup.php?error=none");
        exit();
    }

    function EmptyInputLogin($username, $Pwd)
    {
        if(empty($username) || empty($Pwd)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $Pwd)
    {
        // Nhớ cần phải chú thích login bằng email hay username cũng được
        $UserNameExisted = checkUsernameExisted($conn, $username, $username);
        if($UserNameExisted === false){
            header("Location: ../../login.php?error=WrongUsername");
            exit;
        } 
        $PwdFromDB = $UserNameExisted["user_password"];
        $CheckPwd = password_verify($Pwd,$PwdFromDB);
        if($CheckPwd === false){
            header("Location: ../../login.php?error=WrongPwd");
            exit;
        } else if ($CheckPwd === true) {
            session_start();
            $_SESSION['id'] = $UserNameExisted['id'];
            $_SESSION['user_name'] = $UserNameExisted['user_name'];
            header("Location: ../../index.php");
            exit;
        }
    }

    function requestMoney($id,$amount, $conn)
    {
        $sql ="SELECT request FROM moneymanager WHERE user_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $amount = $amount + $row['request'];
        $sql ="UPDATE moneymanager SET request = ? WHERE user_id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../Recharge.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s", $amount);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../../Recharge.php?error=none");
    }

    function getRequest($conn)
    {
        $sql = "SELECT * FROM moneymanager WHERE request > 0;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        return $result;
    }

    function acceptRequest($conn,$id)
    {
        $sql ="SELECT * FROM moneymanager WHERE user_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $wallet = $row['wallet'];
        $add = $row['request'];
        $wallet = $wallet + $add;
        // Xóa request
        $sql ="UPDATE moneymanager SET request = ? WHERE user_id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../../Manage.php?error=stmtfailed");
            exit();
        }
        $empty = 0;
        mysqli_stmt_bind_param($stmt,"s", $empty);
        mysqli_stmt_execute($stmt);
        // Cập nhật Wallet
        $sql ="UPDATE moneymanager SET wallet = ? WHERE user_id = $id;";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../Manage.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s", $wallet);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../../Manage.php?error=none");
    }

    function deleteRequest($conn,$id)
    {
        // Xóa request
        $sql ="UPDATE moneymanager SET request = ? WHERE user_id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../Manage.php?error=stmtfailed");
            exit();
        }
        $empty = 0;
        mysqli_stmt_bind_param($stmt,"s", $empty);
        mysqli_stmt_execute($stmt);
        // Cập nhật Wallet
        mysqli_stmt_close($stmt);
        header("Location: ../../Manage.php?error=none");
    }

    function getWaller($id,$conn)
    {
        $sql = "SELECT * FROM moneymanager WHERE user_id =  $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    function payup($conn, $id, $amount)
    {
        // Lấy Wallet 
        $sql ="SELECT wallet FROM moneymanager WHERE user_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $wallet = $row['wallet'];
        $wallet = $wallet - $amount;
        // Cập nhật Wallet
        $sql ="UPDATE moneymanager SET wallet = ? WHERE user_id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../Manage.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s", $wallet);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function receiveMoney($conn, $id, $amount)
    {
        // Lấy Wallet 
        $sql ="SELECT wallet FROM moneymanager WHERE user_id = '$id';";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Xử lý lỗi truy vấn
            die("Truy vấn bị lỗi: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        $wallet = $row['wallet'];
        $wallet = $wallet + $amount;
        // Cập nhật Wallet
        $sql ="UPDATE moneymanager SET wallet = ? WHERE user_id = $id;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../Manage.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s", $wallet);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }




    






