<?php

    class Database
    {
        private $dsn = "mysql:host=localhost;dbname=Auth_System";
        private $db_user = "root";
        private $db_password ="";
        public $conn;

        public function __construct()
        {
            $this->conn = $this->conn = new PDO($this->dsn,$this->db_user,$this->db_password);
        }

        public function filter_input($input)
        {           
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);            

            return $input;
        }

        public function validate_input(array $input)
        {
            foreach($input as $key=>$value)
            {
                if(empty($value))
                {
                    $errors[$key] = "$key is required";

                }elseif($key == 'password'){

                    if(strlen($value) < 5)
                    {
                        $errors[$key] = 'password must be atleast 5 characters';
                    }
                }elseif($key == 'confirm_password'){

                    if($value != $input['password'])
                    {
                        $errors[$key] = 'password did not match';
                    }
                   
                }
            }

            if(count($errors) == 0)
            {
                return true;
                
            } else{

                return $errors;
            }
            
           
        }

        public static function random_string()
        {
            $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $string = '';
            for($i=0;$i<10;$i++)
            {
                $string .= $characters[rand(0,strlen($characters) - 1)];
            }

            return $string;
        }

        public static function get_message($type,$text)
        {
            if($type == 'success')
            {
                $message = '
                    <div class="alert alert-success alert-dismissible">
                    
                    <h5>'.$text.'</h5>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                ';
            }else{

                $message = '
                    <div class="alert alert-danger alert-dismissible">
                    
                    <h5>'.$text.'</h5>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                ';
            }

            return $message;
        }

        public function send_mail($to,$subject,$message)
        {
            $eol = "\r\n";
            $headers  = "Reply-To: Divijata Rajan <divijatarajan@gmail.com>".$eol;
            $headers .= "Return-Path: Divijata Rajan <divijatarajan@gmail.com>".$eol;
            $headers .= "From: Divijata Rajan <divijatarajan@gmail.com>".$eol;
            $headers .= "Organization: Divijata".$eol;
            $headers .= "MIME-Version: 1.0".$eol;
            $headers .= "Content-type: text/html; charset=iso-8859-1".$eol;
            $headers .= "X-Priority: 3".$eol;
            $headers .= "X-Mailer: PHP".phpversion().$eol;
            mail($to,$subject,$message,$headers);
            return true;
        }
    }