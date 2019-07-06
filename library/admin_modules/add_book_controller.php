<?php
    include('../core/connection.php');
    if (!isset($_SESSION["admin_login"])) {
        die("ACCESS DENIED");
    }
    if (isset($_POST['add'])) {
        extract($_POST);
        if (empty($isbn)) {
            $_SESSION['error'] = "isbn cannot be empty";
            header('Location:admin_add_book.php');
            die();
        }
        if (empty($title)) {
            $_SESSION['error'] = "title cannot be empty";
            header('Location:admin_add_book.php');
            die();
        }
        if (empty($author)) {
            $_SESSION['error'] = "author cannot be empty";
            header('Location:admin_add_book.php');
            die();
        }
        if (empty($publisher)) {
            $_SESSION['error'] = "publisher cannot be empty";
            header('Location:admin_add_book.php');
            die();
        }
        if (empty($quantity)) {
            $_SESSION['error'] = "quantity cannot be empty";
            header('Location:admin_add_book.php');
            die();
        }
        $result = $conn->query("select * from books where isbn = $isbn");
        if ($result->num_rows > 0 ) {
            $_SESSION['error'] = "isbn already in records";
            header('Location:admin_add_book.php');
            die();
        }
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
            $file_name_to_save = time(). basename($_FILES["image"]["name"]);
           $target_file= $target_dir.$file_name_to_save;
           move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
           $sql = "INSERT into 
                        books(isbn,title,author,publisher,quantity,pic) 
                            values ($isbn,'$title','$author','$publisher',$quantity,'$file_name_to_save')";
           if($conn->query($sql)){
               $_SESSION["message"]="Successfully upload";
           }else{
                $_SESSION["error"]="some error happened";
           }
           header('Location:admin_add_book.php');
    }
}
?>