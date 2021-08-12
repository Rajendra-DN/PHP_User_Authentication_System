<?php

    session_start();
    require_once '../Models/auth.php';
    $user = new Auth();
    if(isset($_GET['email']) && isset($_GET['token']))
    {                
        $email = $_GET['email'];
        $token = $_GET['token'];
        $user_details = $user->get_user($_GET['email']);
        if($user_details && $token == $user_details['token'])
        {
           if(isset($_POST['reset_password_btn']))
           {
                $input = [
                    
                    'password'  => $_POST['password'],
                    'confirm_password' =>   $_POST['confirm_password']
                ];
        
                $validated = $user->validate_input($input);
                
                if($validated === true)
                {
                    if($user->change_password($email,$_POST['password']))
                    {
                        $_SESSION['success'] = Database::get_message('success','Success! your password has been reset, Please login');
                        header("Location: /public/login.php");
                    }                
        
                }
               
           }
    
        }else{
    
            $_SESSION['errors'] = Database::get_message('errors','something went wrong!! please try again');
            header("Location: /public/reset_password.php");
        }
    
    }
    include_once '../layouts/header.php';
    
?>  

<div class="container">
    <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-8 my-auto">
            <div class="card" id="resetPassword">
                <div class="card-header">
                    <h4 class="text-warning">Reset Password</h4>
                </div>
                <div class="card-body p-3">
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="password" name="password" id="newPassword" placeholder="Enter new password" class="form-control">
                        </div>
                        <p class="text-danger"><?= $validated['password'] ?? '' ?></p>
                        <div class="form-group">
                            <input type="password" name="confirm_password" id="confirmNewPassword" placeholder="Confirm new password" class="form-control">
                        </div>
                        <p class="text-danger"><?= $validated['confirm_password'] ?? '' ?></p>
                        <div class="form-group">
                            <input type="submit" name="reset_password_btn" id="" value="Reset Password" class="btn btn-block btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php
   
    include_once '../layouts/footer.php';
?>
