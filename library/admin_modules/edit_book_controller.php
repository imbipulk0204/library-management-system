<?php
    include('../core/connection.php');
    if (!isset($_SESSION["admin_login"])) {
        die("ACCESS DENIED");
    }
    if (isset($_POST['edit'])) {
        $myisbn = $_POST["isbn"];
        $result=$conn->query("select * from books where isbn = $myisbn");
        $row = $result->fetch_assoc();
        extract($row);
        $new_title = !empty($_POST["title"])?$_POST["title"]:$title;
        $new_author = !empty($_POST["author"])?$_POST["author"]:$author;
        $new_publisher = !empty($_POST["publisher"])?$_POST["publisher"]:$publisher;
        $new_quantity = !empty($_POST["quantity"])?$_POST["quantity"]:$quantity;
        $new_pic = $pic;
        if (!empty($_FILES["image"]["name"])) {
          
            $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if($uploadOk==1){
            $new_pic = time(). basename($_FILES["image"]["name"]);
           $target_file= $target_dir.$new_pic;
           move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        }
    }
    $sql = "UPDATE books set
                        title = '$new_title',
                        author = '$new_author',
                        publisher = '$new_publisher',
                        quantity = $new_quantity,
                        pic = '$new_pic' where isbn =  $isbn";
           if($conn->query($sql)){
               $_SESSION["message"]="Successfully edited";
           }else{
               die($conn->error);
                $_SESSION["error"]="some error happened";
           }
           header('Location:admin_book_edit.php?isbn='.$isbn);
        
}
?>