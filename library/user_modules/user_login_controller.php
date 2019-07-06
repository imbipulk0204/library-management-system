<?php
    include('../core/connection.php');
    if (isset($_POST['login'])) {
        extract($_POST);
        if (empty($email)) {
            $_SESSION['error'] = "email cannot be empty";
            header('Location:user_login.php');
            die();
        }
        if (empty($password)) {
            $_SESSION['error'] = "password cannot be empty";
            header('Location:user_login.php');
            die();
        }
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);
        $password = md5($password);
        $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $_SESSION['error'] = "Invalid user credentials";
            header('Location:user_login.php');
            die();
        } else {
            $row = $result->fetch_assoc();
            extract($row);
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $uname;
            $_SESSION['user_login'] = TRUE;
            header('Location:user_profile.php');
        }
    }
?>