<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LandingController;
use Controllers\LoginController;
use Controllers\TaskController;
use MVC\Router;

$router = new Router();

//Routes

//LANDING PAGE
$router->get('/', [LandingController::class, 'landing']);

//AUTH ZONE
//Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Create Account
$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

//Form for if you forgot your password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);

//Type your new password (url for restart your password)
$router->get('/restart', [LoginController::class, 'restart']);
$router->post('/restart', [LoginController::class, 'restart']);

//Confirm account
$router->get('/message', [LoginController::class, 'message']);
$router->get('/confirm', [LoginController::class, 'confirm']);

//DASHBOARD ZONE
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/create-project', [DashboardController::class, 'createProject']);
$router->post('/create-project', [DashboardController::class, 'createProject']);
$router->get('/remove-project', [DashboardController::class, 'removeProject']);
$router->get('/project', [DashboardController::class, 'project']);
$router->get('/calendar', [DashboardController::class, 'calendar']);
$router->post('/calendar', [DashboardController::class, 'calendar']);
$router->get('/remove-calendar', [DashboardController::class, 'removeCalendar']);
$router->get('/profile', [DashboardController::class, 'profile']);
$router->post('/profile', [DashboardController::class, 'profile']);
$router->get('/change-password', [DashboardController::class, 'changePassword']);
$router->post('/change-password', [DashboardController::class, 'changePassword']);

//API for tasks
$router->get('/api/tasks', [TaskController::class, 'index']);
$router->post('/api/tasks', [TaskController::class, 'create']);
$router->post('/api/tasks/update', [TaskController::class, 'update']);
$router->post('/api/tasks/remove', [TaskController::class, 'remove']);

//Check and validate the routes and assign the controller functions
try {
    $router->checkRoutes();
} catch (Exception $exception) {
    header("Location: /");
    exit;
}
