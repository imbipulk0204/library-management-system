<?php 
$date = date("Y-m-d");
include('../core/connection.php');
$isbn = $_GET["isbn"] or die('No isbn Specified');
$user_id = $_SESSION["user_id"];
$sql = "select * from issue where user_id = $user_id and book_id = $isbn and status !=2";
$result = $conn->query($sql);
if ($result->num_rows >0) {
    $_SESSION["error"] = "You Have already requested this book";
    header('Location:user_profile.php');
}else {
    $insert_sql = "insert into issue (user_id,book_id,status,issue_date) values($user_id,$isbn,0,'$date')";
    if ($conn->query($insert_sql)) {
        $_SESSION["message"]="Request made";
        header('Location:user_profile.php');        
    }else {
        echo $conn->error;
    }

}
?>
