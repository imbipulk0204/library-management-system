<?php
    function flash_messages(){
        if (isset($_SESSION["message"])) {?>       
            <div class="alert alert-primary">
                <?php echo $_SESSION["message"];?>
            </div>
        <?php } 
        if (isset($_SESSION['error'])) {?>
            <div class="alert alert-danger">
                <?php echo $_SESSION["error"];?>
            </div>
        <?php }     
        unset($_SESSION['message']);
        unset($_SESSION['error']);
    }
?>