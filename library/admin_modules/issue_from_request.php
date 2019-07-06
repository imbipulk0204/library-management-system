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
    //check book stock
    if ($quantity==0) {
        $_SESSION["error"] = "Book Not in stock";
        header('Location:admin_dashboard.php');
        die();
    }
    //check if user already has 3 issues
    $user_issue = $conn->query("select * from issue where user_id = $user_id and status = 1");
    if ($user_issue->num_rows > 2) {
        $_SESSION["error"] = "User cant have more than 3 issues at a time";
        header('Location:admin_dashboard.php');
        die();
    }
    //finnaly issue the book
    $date = date("Y-m-d");
    $update_sql = "UPDATE issue set status = 1 , issue_date = '$date' where issue_id = $myissue_id";
    
    if ($conn->query($update_sql)) {
        $conn->query("UPDATE books set quantity = quantity - 1 where isbn =$isbn");
        $_SESSION["message"] = "book issued";
        header('Location:admin_dashboard.php');
        die();
    }
?>