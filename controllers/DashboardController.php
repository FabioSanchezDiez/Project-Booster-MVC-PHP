<?php

namespace Controllers;

use Locale;
use Model\Calendar;
use Model\Project;
use Model\User;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $id = $_SESSION["id"];

        $projects = Project::getProjectsWithTags($id);

        $router->render("dashboard/index", [
            'title' => 'Proyectos',
            'projects' => $projects
        ]);
    }

    public static function createProject(Router $router)
    {

        session_start();

        isAuth();

        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $project = new Project($_POST);

            $project->joinTags($project->tags);

            //Validate 
            $alerts = $project->validateProject();

            if (empty($alerts)) {
                //Generate URL for project
                $project->url = md5(uniqid());

                //Save a owner of project
                $project->userId = $_SESSION["id"];

                //Save project
                $project->save();

                //Redirect
                header("Location: /project?id=" . $project->url);
            }
        }


        $router->render("dashboard/create-project", [
            'title' => 'Nuevo Proyecto',
            'alerts' => $alerts
        ]);
    }

    public static function removeProject()
    {

        session_start();

        isAuth();

        $projectId = $_GET["id"] ?? "";
        $userId = $_GET["userId"] ?? "";

        if (!$projectId || !$userId) header("Location: /dashboard");

        $project = Project::where("id", $projectId);

        if (!$project || $project->id !== $projectId || $project->userId !== $userId || $project->userId !== $_SESSION["id"]) header("Location: /dashboard");

        $result = $project->delete();

        if ($result) header("Location: /dashboard");
    }

    public static function project(Router $router)
    {

        session_start();

        isAuth();

        $token = $_GET["id"];

        if (!validateCustomUrl($token)) header("Location: /dashboard");

        if (!$token) header("Location: /dashboard");

        //Check if the person that visit project is the owner of this
        $project = Project::where("url", $token);

        if (!empty($project->id)) {
            if ($project->userId !== $_SESSION["id"]) {
                header("Location: /dashboard");
            }
        }

        $router->render("dashboard/project", [
            'title' => $project->project ?? "Error proyecto no encontrado"
        ]);
    }

    public static function calendar(Router $router)
    {

        session_start();

        isAuth();

        $id = $_SESSION["id"];

        $alerts = [];

        $projects = Project::belongsTo("userId", $id);

        $calendarFull = Calendar::belongsTo("userId", $id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $calendar = new Calendar($_POST);

            //Validate 
            $alerts = $calendar->validateCalendar($calendarFull);

            if (empty($alerts)) {

                $project = Project::where("id", $calendar->projectId);
                $projectUserId =  $project->userId;

                if ($projectUserId !== $calendar->userId) {
                    Calendar::setAlert("error", "Error al agregar el proyecto al calendario, intentelo más tarde");
                } else {
                    $calendar->save();
                    header("Location: /calendar");
                }
            }

            $alerts = Calendar::getAlerts();
        }

        $router->render("dashboard/calendar", [
            'title' => 'Calendario',
            'projects' => $projects,
            'calendarFull' => $calendarFull,
            'alerts' => $alerts
        ]);
    }

    public static function removeCalendar()
    {

        session_start();

        isAuth();

        $calendarId = $_GET["id"] ?? "";
        $userId = $_GET["userId"] ?? "";

        if (!$calendarId || !$userId) header("Location: /calendar");

        $calendar = Calendar::where("id", $calendarId);

        if (!$calendar || $calendar->id !== $calendarId || $calendar->userId !== $userId || $calendar->userId !== $_SESSION["id"]) header("Location: /dashboard");

        $result = $calendar->delete();

        if ($result) header("Location: /calendar");
    }

    public static function profile(Router $router)
    {

        session_start();

        isAuth();

        $alerts = [];

        $user = User::find($_SESSION["id"]);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {


            $user->synchronize($_POST);

            $alerts = $user->validateProfile();
            $alerts = $user->validate;

            if (empty($alerts)) {

                $userExist = User::where("email", $user->email);

                //If exists any user with the same email I can't update data
                if ($userExist && $userExist->id !== $user->id) {
                    $user->setAlert("error", "Email no válido, cuenta ya registrada");
                    $alerts = $user->getAlerts();
                } else {
                    $user->save();
                    $user->setAlert("exito", "Actualizado correctamente");
                    $alerts = $user->getAlerts();
                    $_SESSION["name"] = $user->name;
                    $_SESSION["email"] = $user->email;
                }
            }
        }

        $router->render("dashboard/profile", [
            'title' => 'Configuración',
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function changePassword(Router $router)
    {
        session_start();

        isAuth();

        $alerts = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = User::find($_SESSION["id"]);
            $user->synchronize($_POST);

            $alerts = $user->newPassword();

            if (empty($alerts)) {
                $result = $user->checkPassword();

                if ($result) {
                    $user->password = $user->new_password;

                    //Remove extra properties
                    unset($user->actual_password);
                    unset($user->new_password);

                    //Hash updated password
                    $user->hashPassword();
                    $result = $user->save();

                    if ($result) {
                        $user->setAlert("exito", "Contraseña actualizada correctamente");
                        $alerts = $user->getAlerts();
                    }
                } else {
                    $user->setAlert("error", "Contraseña actual incorrecta");
                    $alerts = $user->getAlerts();
                }
            }
        }

        $router->render("dashboard/change-password", [
            'title' => "Cambiar contraseña",
            'alerts' => $alerts
        ]);
    }
}
