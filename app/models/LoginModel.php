<?php

class LoginModel
{
    static function login(){
        if (isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $db = new Database();

            $results = $db->getEmail($email);
            if($results == true){
                // Le compte existe
                if (password_verify($pass, $results[0]->password)) {
                    session_start();
                    $_SESSION['id'] = $results[0]->id;
                    $_SESSION['prenom'] = $results[0]->prenom;
                    $_SESSION['email'] = $results[0]->email;
                    $db->loginNow($_SESSION['id']);
                    return true;
                }else {
                    return false;
                }
            }else{
                return false;
            }
        }


    }


    static function logout(){
        session_start();
        $db = new Database();
        $db->logout($_SESSION['id']);
        session_unset();
        session_destroy();
    }
}