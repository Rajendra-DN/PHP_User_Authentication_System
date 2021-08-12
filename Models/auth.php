<?php

    require_once 'database.php';

    class Auth extends Database
    {
        public function register_user(array $input)
        {
            $validated = $this->validate_input($input);           
            if($validated === true)
            {
                $data = [
                    
                    'name' => $this->filter_input($input['name']),
                    'email' => $this->filter_input($input['email']),
                    'password' => password_hash($input['password'],PASSWORD_DEFAULT),
                    
                ];
                
                $sql = "INSERT INTO users(name, email, password,created_at,updated_at) values (:name, :email, :password, NOW(), NOW())";

                $statement = $this->conn->prepare($sql);

                $statement->execute(['name'=>$data['name'], 'email'=>$data['email'], 'password'=>$data['password']]);

                return true;

            }else{

                return $validated;
            }
            
        }

        public function get_user($email)
        {
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $this->conn->prepare($sql);
            $statement->execute(['email'=>$email]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function verify_user($email)
        {
            $sql = "UPDATE users SET is_verified = :verified WHERE email = :email";
            $statement = $this->conn->prepare($sql);
            $statement->execute(['verified'=>true,'email'=>$email]);

            return true;
        }

        public function change_password($email,$password)
        {
            $sql = "UPDATE users SET password = :password, updated_at = NOW() WHERE email = :email";
            $statement = $this->conn->prepare($sql);
            $statement->execute(['password'=>password_hash($password,PASSWORD_DEFAULT),'email'=>$email]);

            return true;
        }

        public function forgot_password($email,$token)
        {
            $sql = "UPDATE users SET token = :token WHERE email = :email";
            $statement = $this->conn->prepare($sql);
            $statement->execute(['token'=>$token,'email'=>$email]);

            return true;
        }
    }

    