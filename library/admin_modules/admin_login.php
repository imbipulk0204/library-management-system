<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (isset($_SESSION['admin_login'])) {
    header('Location:admin_dashboard.php');
}?>
<?php if (isset($_SESSION['user_login'])) {
    die('only admin can access here, please login as admin');
}?>
<div class="container">
    <h2 class="mt-5 text-secondary">
        Login to your Account
        <hr>
    </h2>
    <?php flash_messages(); ?>
    <div class="card w-50 my-5 mx-auto">
        <div class="card-header">
            ADMIN LOGIN
        </div>
        <div class="card-body">
            <form action="admin_login_controller.php" method="post">
                <input type="text" class="form-control mt-4" name="aname" placeholder="aname">
                <input type="password" class="form-control mt-4" name="password" placeholder="Password">
                <input name="login" type="submit" value="Login" class="btn btn-outline-success mt-4">
            </form>
        </div>
    </div>
</div>
</body>
<?php include('../layout_components/footer.php');?>
</html>