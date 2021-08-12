<?php

    session_start();
    if(isset($_SESSION['user_info']))
    {
        header("Location: /public/");
    }
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
                    <h3 class="text-primary">Sign in to your account</h3>
                </div>
                <div class="card-body">
                <form action="/Controllers/action.php" method="post" id="login_form" class="px-3">
                        <div id="loginError"></div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                            <input type="email" name="email" id="login_email" class="form-control rounded-0" placeholder="E-mail" required value="<?= $_COOKIE['email'] ?? '' ?>">
                        </div>

                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="bi bi-key"></i>
                                </span>
                            </div>
                            <input type="password" name="password" id="login_password" class="form-control rounded-0" placeholder="Password" required value="<?= $_COOKIE['password'] ?? '' ?>">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" name="remember" id="customCheck" class="custom-control-input" <?php if(isset($_COOKIE['email'])) {?> checked <?php } ?>>
                                <label for="customCheck" class="custom-control-label">Remember me</label>
                            </div>
                            <div class="forgot float-right">
                                <a href="forgot_password.php" id="forgot_link">forgot password?</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="login_btn" id="login_btn" class="btn btn-primary btn-block myBtn" value="Sign In">
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

