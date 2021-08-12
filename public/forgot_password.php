<?php

    session_start();
    include_once __DIR__.'/../layouts/header.php';

?>
<div class="container">
    <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-8 my-auto">
            <?php
                if(isset($_SESSION['success']))
                {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }elseif(isset($_SESSION['failed'])){

                    echo $_SESSION['failed'];
                    unset($_SESSION['failed']);
                }

            ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-info">Enter email to receive password reset link</h3>
                </div>
                <div class="card-body">
                <form action="/Controllers/action.php" method="post" id="forgot_form" class="px-3">
                        
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                            <input type="email" name="email" id="login_email" class="form-control rounded-0" placeholder="E-mail" required >
                        </div>

                        <div class="form-group">
                            <input type="submit" name="forgot_btn" id="forgot_btn" class="btn btn-info btn-block myBtn" value="Send Password Reset Link">
                        </div>
                        <p>Don't have an account? <a href="register.php">Register Here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

    include_once __DIR__.'/../layouts/footer.php';
    
?>

