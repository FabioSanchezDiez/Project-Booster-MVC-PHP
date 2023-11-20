<?php

namespace Controllers;

use MVC\Router;

class LandingController
{
    public static function landing(Router $router)
    {
        session_start();

        //Render to view
        $router->render('landing/landing', [
            'title' => 'Inicio'
        ]);
    }
}
