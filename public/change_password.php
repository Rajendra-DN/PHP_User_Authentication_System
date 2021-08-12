<?php

    session_start();
    if(!isset($_SESSION['user_info']))
    {
        
        header("Location: /login.php");
    }
    include_once '../layouts/header.php';
    include_once '../layouts/navbar.php';
?>  

    <div class="row">
        <div class="col-lg-6 pt-5">
            <div class="card" id="changePassword">
                <div class="card-header">
                    <h4 class="text-warning">Change Password</h4>
                </div>
                <div class="card-body p-3">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="password" name="password" id="newPassword" placeholder="Enter new password" class="form-control">
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></p>
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="confirmNewPassword" placeholder="Confirm new password" class="form-control">
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['confirm_password'] ?? '' ?></p>
                        <div class="form-group">
                            <input type="submit" name="change_password" id="" value="Change Password" class="btn btn-block btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php

    unset($_SESSION['errors']);
    include_once '../layouts/footer.php';
?>
