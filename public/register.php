<?php
    session_start();
    include_once '../layouts/header.php';
    
?>
<div class="container">
    <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-8 my-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary">Create your account</h3>
                </div>
                <div class="card-body p-3">
                    <form action="/Controllers/action.php" method="POST" id="register_form">
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-person"></i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="User Name" value="<?= $_SESSION['input']['name'] ?? '' ?>">
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['name'] ?? '' ?></p>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                            <input type="email" name="email" id="login_email" class="form-control rounded-0" placeholder="E-mail" value="<?= $_SESSION['input']['email'] ?? '' ?>">
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></p>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-key"></i>
                                </span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" >
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></p>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="bi bi-key"></i>
                                </span>
                            </div>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control rounded-0" placeholder="Confirm Password" >
                        </div>
                        <p class="text-danger"><?= $_SESSION['errors']['confirm_password'] ?? '' ?></p>
                        <div class="form-group">
                            <input type="submit" name="RegisterBtn" id="register_btn" class="btn btn-primary btn-block myBtn" value="Sign Up">
                        </div>
                        <p>Already have an account? <a href="login.php">Login Here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once '../layouts/footer.php';
    session_destroy();
?>

