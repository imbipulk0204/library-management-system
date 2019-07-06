<?php include('../layout_components/head.php')?>
<?php include('../core/utilities.php');?>
<?php if (isset($_SESSION['login'])) {
    header('Location:user_profile.php');
}?>
<div class="container">
    <h2 class="mt-5 text-secondary">
        Register New Account
        <hr>
    </h2>
    <?php flash_messages(); ?>
    <div class="card w-50 my-5 mx-auto">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action="user_register_controller.php" method="post">
                <input type="text" class="form-control mt-4" name="email" placeholder="Email">
                <input type="text" class="form-control mt-4" name="name" placeholder="Name">
                <input type="password" class="form-control mt-4" name="cpassword" placeholder="Confirm Password">
                <input type="password" class="form-control mt-4" name="password" placeholder="Password">
                <input name="register" type="submit" value="Register" class="btn btn-outline-success mt-4">
                <a href="user_login.php" class="btn mt-4 text-primary">or Login</a>
            </form>
        </div>
    </div>
</div>
</body>
<?php include('../layout_components/footer.php');?>
</html>