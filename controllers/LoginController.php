<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        session_start();
        if(isset($_SESSION["login"])) header("Location: /dashboard");

        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);

            $alerts = $user->validateLogin();

            if(empty($alerts)){
                //Check if the user exist
                $user = User::where("email", $user->email);
                
                if(!$user || !$user->confirmed) {
                    User::setAlert("error", "El usuario no existe o no esta confirmado");
                } else{
                    //User exists
                    if(password_verify($_POST["password"], $user->password)){
                        
                        //Start session of user
                        session_start();
                        $_SESSION["id"] = $user->id;
                        $_SESSION["name"] = $user->name;
                        $_SESSION["email"] = $user->email;
                        $_SESSION["login"] = true;

                        //Redirect
                        header("Location: /dashboard");

                    } else{
                        User::setAlert("error", "Contraseña incorrecta");
                    }
                }
            }
        }

        $alerts = User::getAlerts();

        //Render to view
        $router->render('auth/login', [
            'title' => 'Inicia sesión',
            'alerts' => $alerts
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header("Location: /");
    }

    public static function create(Router $router)
    {

        //I create a empty instance of user and a empty array for contain the alerts
        $alerts = [];
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronize($_POST);
            $alerts = $user->validateNewAccount();

            //If alertas is empty I check if the user that try register already exists
            if (empty($alerts)) {
                $existsUser = User::where("email", $user->email);

                if ($existsUser) {
                    User::setAlert("error", "El usuario ya esta registrado");
                    $alerts = User::getAlerts();
                } else {

                    //Hash password
                    $user->hashPassword();

                    //Remove password2
                    unset($user->password2);

                    //Generate token
                    $user->createToken();

                    //Create new user
                    $result = $user->save();

                    //Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();

                    if ($result) {
                        header("Location: /message");
                    }
                }
            }
        }

        //Render to view
        $router->render('auth/create', [
            'title' => 'Crea tu cuenta',
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function forgot(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateEmail();

            if (empty($alerts)) {
                $user = User::where("email", $user->email);

                if ($user && $user->confirmed && !$user->token) {

                    //Generate new token
                    $user->createToken();
                    unset($user->password2);

                    //Update user
                    $user->save();

                    //Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendResetPassword();

                    //Set alert
                    User::setAlert("exito", "Hemos enviados las instrucciones a tu email");
                } else {

                    User::setAlert("error", "El usuario no existe o no esta confirmado");
                    User::setAlert("error", "En caso de que el usuario exista ya se le han enviado las instrucciones");
                }
            }
        }

        $alerts = User::getAlerts();

        //Render to view
        $router->render('auth/forgot', [
            'title' => 'Olvidé mi Contraseña',
            'alerts' => $alerts
        ]);
    }

    public static function restart(Router $router)
    {
        $token = s($_GET["token"]);
        $show = true;
        
        if(!$token) header("Location: /");

        //Find user with this token
        $user = User::where("token", $token);

        if(empty($user)){
            User::setAlert("error", "Token no válido");
            $show = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Add new password
            $user->synchronize($_POST);

            //Validate password
            $alerts = $user->validatePassword();

            if(empty($alerts)){
                //Hash new password
                $user->hashPassword();

                //Remove token
                $user->token = null;

                //Save user in db
                $result = $user->save();

                //Redirect
                if($result){
                    User::setAlert("exito", "Contraseña cambiada correctamente");
                    header("refresh:3;url=/");
                }
            }
        }

        $alerts = User::getAlerts();

        //Render to view
        $router->render('auth/restart', [
            'title' => 'Reestablecer Contraseña',
            'alerts' => $alerts,
            'show' => $show
        ]);
    }

    public static function message(Router $router)
    {
        //Render to view
        $router->render('auth/message', [
            'title' => 'Confirmación'
        ]);
    }

    public static function confirm(Router $router)
    {

        $token = s($_GET["token"]);

        if (!$token) header("Location: /");

        //Find user with this token
        $user = User::where("token", $token);

        if (empty($user)) {
            //In db didn't find user with this token
            User::setAlert("error", "Token no válido");
        } else {
            //Confirm account
            $user->confirmed = 1;
            $user->token = null;
            unset($user->password2);

            //Update in db
            $user->save();
            User::setAlert("exito", "Cuenta confirmada correctamente");
        }

        $alerts = User::getAlerts();

        //Render to view
        $router->render('auth/confirm', [
            'title' => 'Confirmación',
            'alerts' => $alerts
        ]);
    }
}
