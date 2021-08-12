<?php
    session_start();
    require_once __DIR__.'/../Models/auth.php';
    $user = new Auth();
    if(isset($_POST['RegisterBtn']))
    {
        $input = [
            'name'  =>  $_POST['name'],
            'email'  =>  $_POST['email'],
            'password'  => $_POST['password'],
            'confirm_password' =>   $_POST['confirm_password']
        ];

        $result = $user->register_user($input);
        if($result === true)
        {
            $to = $_POST['email'];
            $subject = 'E-mail confirmation Link';          
            $message = '<p>Please click the below link to confirm your email </p><a href="user-auth.test/Controllers/action.php?email='.$to.'">click here</a>';
            
            if($user->send_mail($to,$subject,$message))
            {
                $_SESSION['success'] = Database::get_message('success','Success! Please verify your email and confirm to login');
                header("Location: /public/login.php");
            }
            
            
        }
        else
        {
            $_SESSION['errors'] = $result;
            $_SESSION['input'] = $input;
            header("Location: /public/register.php");
        }
    }

    if(isset($_GET['email']))
    {
       $user_details = $user->get_user($_GET['email']);
       if($user_details && $user_details['is_verified'] == false)
       {
           if($user->verify_user($user_details['email']))
           {
                $_SESSION['success'] = Database::get_message('success','Success! Please login');
                header("Location: /public/login.php");
           }           
           
       }else{

            $_SESSION['failed'] = Database::get_message('failed','Sorry! user not found');
            header("Location: /public/login.php");
       }
    }

    if(isset($_POST['login_btn']))
    {
        $user_details = $user->get_user($_POST['email']);
        if($user_details)
        {
            if($user_details['is_verified'])
            {

                if(password_verify($_POST['password'],$user_details['password']))
                {
                    $_SESSION['user_info'] = $user_details;
                    if(!empty($_POST['remember']))
                    {
                        setcookie("email", $_POST['email'], time()+(30*24*60*60), '/');
                        setcookie("password", $_POST['password'], time()+(30*24*60*60), '/');
                    }else{

                        setcookie("email", "", 1, '/');
                        setcookie("password", "", 1, '/');
                    }                    
                    header("Location: /public/");

                }else{

                    $_SESSION['failed'] = Database::get_message('failed','you entered wrong password');
                    header("Location: /public/login.php");
                }

            }else{

                $_SESSION['failed'] = Database::get_message('failed','please verify your email to continue');
                header("Location: /public/login.php");
            }
        }else{

            $_SESSION['failed'] = Database::get_message('failed','This email is invalid');
            header("Location: /public/login.php");
        }
    }

    if(isset($_POST['change_password']))
    {
        if(isset($_SESSION['user_info']))
        {
            $input = [
                
                'password'  => $_POST['password'],
                'confirm_password' =>   $_POST['confirm_password']
            ];

            $validated = $user->validate_input($input);
            if($validated === true)
            {
                if($user->change_password($_SESSION['user_info']['email'],$_POST['password']))
                {
                    $_SESSION['success'] = Database::get_message('success','Success! password updated, Please login');
                    unset($_SESSION['user_info']);
                    header("Location: /public/login.php");
                }                

            }else{

                $_SESSION['errors'] = $validated;
                header("Location: /public/change_password.php");
            }

        }else{

            $_SESSION['errors'] = Database::get_message('errors','please login to continue');
            header("Location: /public/login.php");
        }
    }

    if(isset($_POST['forgot_btn']))
    {
        $user_details = $user->get_user($_POST['email']);
        if($user_details)
        {
            $token = Database::random_string();
            if($user->forgot_password($user_details['email'],$token))
            {
                $to = $user_details['email'];
                $subject = "Password reset link";
                $message = '<p>Please click the below link to reset your password </p><a href="user-auth.test/public/reset_password.php?email='.$to.'&token='.$token.'">Reset Password</a>';
                if($user->send_mail($to,$subject,$message))
                {
                    $_SESSION['success'] = Database::get_message('success','password reset link has been sent to your email.');
                    header("Location: /public/forgot_password.php");
                }
            }
            
        }else{

            $_SESSION['errors'] = Database::get_message('errors','This email is invalid');
            header("Location: /public/forgot_password.php");
        }
    }

    
    
    