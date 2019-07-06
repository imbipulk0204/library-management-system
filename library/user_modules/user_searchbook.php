<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (!isset($_SESSION['user_login'])) {
    header('Location:user_login.php');
}?>
<?php if (isset($_SESSION['admin_login'])) {
    die('only users can access here, please login as user');
}?>
<?php
    if (isset($_GET["book_name"])) {
        $bookname=$_GET["book_name"];
    }else{
        $bookname="";
    }
    $sql = "select * from books where title like '%$bookname%'";
    $result = $conn->query($sql);
?>
<div class="container">
    <div class="text-center">
        <h1 class="text-secondary">Students Dashboard</h1>
        <hr class=" w-75 " style="background:darkgrey;padding-top:5px;">
    </div>
    <div class="search p-5 text-center">
        <form action="user_searchbook.php" class="search">
            <div class="row m-0 w-75 mx-auto">
                <input style="border-radius:0;" type="text" name="book_name" class="form-control col-9" placeholder="Search Books">
                <input style="border-radius:0" type="submit" name="search" class="btn btn-primary col-3 " value="Seach">
            </div>
        </form>
    </div>
    <div class="issues p-5 ">
        <h1>Search Result</h1>
        <hr class="bg-dark pt-1 w-75 ml-0">
        <div class="row m-0 justify-content-center">
            <?php if ($result->num_rows>0) {
                while ($row=$result->fetch_assoc()) {
                    extract($row);
            ?>
            <div class="col-md-3 card p-0">
                <div class="card-image" style="overflow:hidden;height:150px">
                    <img class="w-100" src="../uploads/<?php echo $pic?>" alt="">
                </div>
                <div class="card-body">
                    <h2 class=""><?php echo $title?></h2>
                    <hr>
                    <small class="text-dark"><?php echo $author?></small>
                    <hr>
                    <small class="text-dark"><?php echo $publisher?></small>
                    <hr>
                    <small class="text-dark"><?php echo $quantity?> peices avilable</small>
                </div>
                <div class="card-footer">
                    <a 
                        href="user_request.php?isbn=<?php echo $isbn;?>" 
                        class="btn btn-outline-success btn-sm w-100">Request</a>
                </div>
            </div>
                <?php }}?>
        </div>
    </div>
</div>
<?php include('../layout_components/footer.php')?>