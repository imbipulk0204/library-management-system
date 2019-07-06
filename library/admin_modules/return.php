<?php
    include('../core/connection.php');
    if (!isset($_SESSION["admin_login"])) {
        die("ACCESS DENIED");
    }
    $myissue_id = $_GET["issue_id"];
    $sql = "select * from issue i join books b on i.book_id = b.isbn";
    $result  = $conn->query($sql);
    $row = $result->fetch_assoc();
    extract($row);

    $date = date("Y-m-d");
    $update_sql = "UPDATE issue set status = 2 , return_date = '$date' where issue_id = $myissue_id";
    
    if ($conn->query($update_sql)) {
        $conn->query("UPDATE books set quantity = quantity + 1 where isbn =$isbn");
        $_SESSION["message"] = "book returned";
        header('Location:admin_show_all_issue.php');
        die();
    }
?>