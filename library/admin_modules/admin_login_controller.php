<?php
    include('../core/connection.php');
    if (isset($_POST['login'])) {
        extract($_POST);
        if (empty($aname)) {
            $_SESSION['error'] = "aname cannot be empty";
            header('Location:admin_login.php');
            die();
        }
        if (empty($password)) {
            $_SESSION['error'] = "password cannot be empty";
            header('Location:admin_login.php');
            die();
        }
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);
        $sql = "SELECT * FROM admin WHERE aname = '$aname' and password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $_SESSION['error'] = "Invalid user credentials";
            header('Location:admin_login.php');
            die();
        } else {
            $_SESSION['admin_login'] = TRUE;
            header('Location:admin_dashboard.php');
        }
    }
?>