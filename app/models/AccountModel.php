<?php

class AccountModel
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
                    $db->setNullLoginTentative($results[0]->id);

                    return true;
                }else {
                    $db->incrementLoginTentative($results[0]->id);
                    $resultLogin = ($db->getLoginTentative($results[0]->id));
                    if(intval($resultLogin[0]->login_tentative) == 3)
                    {
                        $_SESSION['error'] = "Compte bloqué, veuillez recréer un mot de passe";
                    }
                    else
                    {
                        $_SESSION['error'] = "Erreur mdp/login";
                    }
                    return false;
                }
            }else{
                return false;
            }
        }
    }


    static function logout(){
        session_start();
        session_unset();
        session_destroy();
    }


    static function recoverPassword(){

    }
}