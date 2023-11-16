<?php

namespace Controllers;

use Locale;
use Model\Calendar;
use Model\Project;
use MVC\Router;

class DashboardController{

    public static function index(Router $router){

        session_start();

        isAuth();

        $id = $_SESSION["id"];

        $projects = Project::getProjectsWithTags($id);

        $router->render("dashboard/index", [
            'title' => 'Proyectos',
            'projects' => $projects
        ]);
    }

    public static function createProject(Router $router){

        session_start();

        isAuth();

        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $project = new Project($_POST);

            $project->joinTags($project->tags);

            //Validate 
            $alerts = $project->validateProject();

            if(empty($alerts)){
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

        if(!$projectId || !$userId) header("Location: /dashboard");

        $project = Project::where("id", $projectId);
       
        if (!$project || $project->id !== $projectId || $project->userId !== $userId || $project->userId !== $_SESSION["id"]) header("Location: /dashboard");

        $result = $project->delete();

        if($result) header("Location: /dashboard");
    
    }

    public static function project(Router $router){

        session_start();

        isAuth();

        $token = $_GET["id"];

        if(!validateCustomUrl($token)) header("Location: /dashboard");

        if(!$token) header("Location: /dashboard");

        //Check if the person that visit project is the owner of this
        $project = Project::where("url", $token);

        if(!empty($project->id)){
            if($project->userId !== $_SESSION["id"]){
                header("Location: /dashboard");
            }
        } 

        $router->render("dashboard/project", [
            'title' => $project->project ?? "Error proyecto no encontrado"
        ]);
    }

    public static function calendar(Router $router){

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

            if(empty($alerts)){

                $project = Project::where("id", $calendar->projectId);
                $projectUserId =  $project->userId;
                
                if($projectUserId !== $calendar->userId){
                    Calendar::setAlert("error", "Error al agregar el proyecto al calendario, intentelo más tarde");
                } else{
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

    public static function profile(Router $router){

        session_start();

        isAuth();

        $router->render("dashboard/profile", [
            'title' => 'Perfil'
        ]);
    }

}