<?php

namespace Controllers;

use Model\Project;
use Model\Task;

class TaskController
{
    public static function index()
    {
        $projectId = $_GET["id"];

        if (!$projectId) header("Location: /dashboard");

        $project = Project::where("url", $projectId);
        session_start();

        if (!$project || $project->userId !== $_SESSION["id"]) header("Location: /404");

        $tasks = Task::belongsTo("projectId", $project->id);
        echo json_encode(["tasks" => $tasks]);
    }

    public static function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $project = Project::where("url", $_POST["projectId"]);

            if (!$project || $project->userId !== $_SESSION["id"]) {
                $answer = [
                    'type' => 'error',
                    'message' => "Error al agregar tarea, intentalo más tarde"
                ];
                echo json_encode($answer);
                return;
            }

            //If all is good, we create a instance of task
            $task = new Task($_POST);
            $task->projectId = $project->id;
            $result = $task->save();

            $answer = [
                'type' => 'exito',
                'id' => $result["id"],
                'message' => "Se ha creado la tarea correctamente",
                'projectId' => $project->id
            ];

            echo json_encode($answer);
        }
    }

    public static function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $project = Project::where("url", $_POST["projectId"]);

            if (!$project || $project->userId !== $_SESSION["id"]) {
                $answer = [
                    'type' => 'error',
                    'message' => "Error al actualizar la tarea, intentalo más tarde"
                ];
                echo json_encode($answer);
                return;
            }

            $task = new Task($_POST);
            $task->projectId = $project->id;
            $result = $task->save();

            if($result){
                $answer = [
                    'type' => 'exito',
                    'id' => $task->id,
                    'projectId' => $project->id,
                    'message' => "Se ha actualizado la tarea correctamente",
                ];

                echo json_encode($answer);
            }
            
        }
    }

    public static function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $project = Project::where("url", $_POST["projectId"]);

            if (!$project || $project->userId !== $_SESSION["id"]) {
                $answer = [
                    'type' => 'error',
                    'message' => "Error al actualizar la tarea, intentalo más tarde"
                ];
                echo json_encode($answer);
                return;
            }

            $task = new Task($_POST);
            $result = $task->delete();

            $result = [
                'result' => $result,
                'message' => "Eliminado correctamente",
                'type' => "exito"
            ];

            echo json_encode($result);

        }
    }
}
