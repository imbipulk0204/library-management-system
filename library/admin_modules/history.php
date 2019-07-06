<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (!isset($_SESSION['admin_login'])) {
    header('Location:admin_login.php');
}?>
<?php if (isset($_SESSION['user_login'])) {
    die('only admin can access here, please login as admin');
}?>
<div class="container">
    <div class="text-center">
        <h1 class="text-secondary">Admin Dashboard</h1>
        <hr class=" w-75 " style="background:darkgrey;padding-top:5px;">
    </div>
    <div class="search p-5 text-center">
    <?php flash_messages(); ?>
        <form action="admin_searchbook.php" class="search">
            <div class="row m-0 w-75 mx-auto">
                <input style="border-radius:0;" type="text" name="book_name" class="form-control col-9" placeholder="Search Books">
                <input style="border-radius:0;" type="submit" name="search" class="btn btn-primary col-3 " value="Seach">
            </div>
        </form>
    </div>
    <div class="issues p-5 ">
        <h1 class="text-">History</h1>
        <hr class="bg-dark pt-1 w-75 ml-0">
        <div class="list-group">
        <?php
            $sql = "select * from issue i join books b on i.book_id = b.isbn join user u on i.user_id = u.id where status = 2";
            $issues = $conn->query($sql);
            if($issues->num_rows>0){
                while ($row = $issues->fetch_assoc()) {
                    extract($row);
                
        ?>
            <div class="list-group-item">
                    <div class="row m-0">
                        <div class="col" style="overflow:hidden;height:130px;">
                            <img src="../uploads/<?php echo $pic?>" alt="" width="100%">
                        </div>
                        <div class="col">
                            <p class="lead"><?php echo $title?></p>
                            <small><?php echo $author?></small>
                            <hr>
                            <small><?php echo $publisher?></small>
                        </div>
                        <div class="col">
                            <h3><?php echo $uname?></h3>
                            <p class="lead"><?php echo $email?></p>
                            <small>req date <?php echo $issue_date;?></small>
                        </div>
                        <div class="col">
                            <small>Rertun date <hr><?php echo $return_date;?></small>
                        </div>
                    </div>
            </div>
        <?php }} else{?>
        <h1>No History Yet</h1>
        <?php }?>
        </div>
    </div>
</div>
<?php include('../layout_components/footer.php')?>