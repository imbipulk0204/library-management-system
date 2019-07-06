<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (!isset($_SESSION['admin_login'])) {
    header('Location:admin_login.php');
}?>
<?php if (isset($_SESSION['user_login'])) {
    die('only admin can access here, please login as admin');
}?>
<div class="container">
    <h1 class="text-secondary">ADD BOOK</h1>
    <hr class="pt-1 bg-warning">
    <?php flash_messages(); ?>
    <div class="card w-50 my-5 mx-auto">
        <div class="card-header">
            ADMIN ADD BOOK
        </div>
        <div class="card-body">
            <form action="add_book_controller.php" method="post" enctype="multipart/form-data">
                <input type="text" class="form-control mt-4" name="isbn" placeholder="ISBN">                
                <input type="text" class="form-control mt-4" name="title" placeholder="Title">
                <input type="text" class="form-control mt-4" name="publisher" placeholder="publisher">
                <input type="text" class="form-control mt-4" name="author" placeholder="Author">
                <input type="number" class="form-control mt-4" name="quantity" placeholder="Quantity">
                <input type="file" class="form-control mt-4" name="image" placeholder="Choose Image">
                <input name="add" type="submit" value="Add" class="btn btn-outline-success mt-4">
            </form>
        </div>
    </div>
</div>