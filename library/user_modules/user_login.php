<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (isset($_SESSION['user_login'])) {
    header('Location:user_profile.php');
}?>
<?php if (isset($_SESSION['admin_login'])) {
    die('only users can access here, please login as user');
}?>
<div class="container">
    <h2 class="mt-5 text-secondary">
        Login to your Account
        <hr>
    </h2>
    <?php flash_messages(); ?>
    <div class="card w-50 my-5 mx-auto">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form action="user_login_controller.php" method="post">
                <input type="text" class="form-control mt-4" name="email" placeholder="Email">
                <input type="password" class="form-control mt-4" name="password" placeholder="Password">
                <input name="login" type="submit" value="Login" class="btn btn-outline-success mt-4">
                <a href="user_register.php" class="btn mt-4 text-primary">or Register</a>
            </form>
        </div>
    </div>
</div>
</body>
<?php include('../layout_components/footer.php');?>
</html>