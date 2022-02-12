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
                    if(intval($resultLogin[0]->login_tentative) >= 3)
                    {
                        $_SESSION['error'] = "Compte bloqué, veuillez recréer un mot de passe";
                        $db->setNullPassword($results[0]->id);
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
        if (isset($_POST['email']) && $_POST['email'] != '') {
            $db = new Database();

            $email = $_POST['email'];

            $results = $db->getIdFromEmail($email);

            if ($results) {

                $idUser = $results[0]->id;

                $token = sha1(uniqid($idUser, true));
                $url = "hot/account/newPassword?t=" . $token . "&u=" . $idUser;

                $db->generateToken($idUser, $token);

                $message = '
            <html>

            <head>
                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                <title>Réinitialisation du mot de passe HotHotHot</title>
                <link rel="import" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap">
                <link rel="import" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap">
            </head>
           
            <body style=" margin: 0; padding: 0; background-color: #fff; font-family: \'Noto Sans JP\', sans-serif; color: #000; text-align: center;">
                <h1 style="padding-top: 100px; font-size: 2.5em; font-family: \'Ubuntu\', sans-serif;">Réinitialisation du mot de passe</h1>
                <p>Bonjour, ' . $email . '.
                    <br>Afin de finaliser la réinitialisation de votre compte merci de vous rendre sur le lien
                    suivant :</p>
                <a style="color: #2a6bb3; text-decoration: underline;" href="' . $url . '" target="_blank">Lien de réinitialisation</a>
                <br><br><br><br><br>
            </body>
           
            </html>
            ';

                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = 'From: shorty83700@gmail.com';

                $subject = "Réinitialisation du mot de passe";


                if (mail($email, $subject, $message, implode("\r\n", $headers))) {
                    header('location: /account/login');
                    $_SESSION['error']= "Mot de passe modifié";
                } else {
                    echo('mail-error');
                    header('location: ../login.php');

                }
            } else {
                echo('❌');
                header('location: ../login.php');

            }
        }


    }
}