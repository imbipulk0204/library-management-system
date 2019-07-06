<?php
    include('../core/connection.php');
    if (!isset($_SESSION["admin_login"])) {
        die("ACCESS DENIED");
    }
    $myissue_id = $_GET["issue_id"];
    $delete_sql = "Delete from issue where issue_id = $myissue_id";
    
    if ($conn->query($delete_sql)) {
        $_SESSION["message"] = "Request Declined Successfuly";
        header('Location:admin_dashboard.php');
        die();
    }
?>