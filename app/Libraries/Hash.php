<?php
    namespace App\Libraries;

    class Hash {
        public function encrypt($password){
            return password_hash($password, PASSWORD_BCRYPT);
        }

        public function check($userPassword, $dbUserPassword){
            if(password_verify($userPassword, $dbUserPassword)){
                return true;
            }
            return false;
        }
    }
?>