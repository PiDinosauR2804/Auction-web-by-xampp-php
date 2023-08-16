<?php

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email  = $_POST['email'];
        $Pwd = $_POST['pwd'];
        $RepeatPwd = $_POST['rptpwd'];

        require_once 'dbh.inc.php';
        require_once 'function.inc.php';
        
        if(empty($name) ||  empty($username) || empty($email) || empty($Pwd) || empty($RepeatPwd)){
            header("Location: ../../signup.php?error=emptyinput");
            exit;
        }
        if(checkInvalidUserName($username) !== false){
            header("Location: ../../signup.php?error=invalidUsername");
            exit;
        }
        if(checkUsernameExisted($conn, $username, $email) !== false){
            header("Location: ../../signup.php?error=UsernameExisted");
            exit;
        }
        if(checkInvalidEmail($email) !== false){
            header("Location: ../../signup.php?error=invalidEmail");
            exit;
        }
        if (checkValidatePassword($Pwd) !== false){
            header("Location: ../../signup.php?error=invalidPassword");
            exit;
        }
        if(checkIfPwdMatch($Pwd, $RepeatPwd) !== false){
            header("Location: ../../signup.php?error=PwdUnmatch");
            exit;
        }
        createUser($conn, $name, $username, $email, $Pwd);

    } else {
        header("Location: ../../signup.php");
        exit;
    }