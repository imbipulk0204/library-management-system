<?php
    include('../core/connection.php');
    if (isset($_POST['register'])) {
        extract($_POST);
        if (empty($name)) {
            $_SESSION['error'] = "name cannot be empty";
            header('Location:user_register.php');
            die();
        }
        if (empty($email)) {
            $_SESSION['error'] = "email cannot be empty";
            header('Location:user_register.php');
            die();
        }
        if (empty($cpassword)) {
            $_SESSION['error'] = "confirm password cannot be empty";
            header('Location:user_register.php');
            die();
        }
        if (empty($password)) {
            $_SESSION['error'] = "password cannot be empty";
            header('Location:user_register.php');
            die();
        }
        if($password != $cpassword){
            $_SESSION['error'] = "password confirmation failed";
            header('Location:user_register.php');
        }
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);
        $sql = "SELECT * FROM  user WhERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $_SESSION['error'] = "email Already occupied";
            header('Location:user_register.php');
        }else{
            $password = md5($password);
            $insert_sql = "insert into user (uname, email, password) values ('$name','$email','$password')";
            $conn->query($insert_sql);
            $_SESSION['message'] = "Registration Successful";
            header('Location:user_login.php');
        }
    }
?>