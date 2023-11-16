<?php

namespace Model;

class Project extends ActiveRecord
{
    protected static $table = "projects";
    protected static $dbColumns = ["id", "project", "url", "userId", "tags"];

    public $id;
    public $project;
    public $url;
    public $userId;
    public $tags;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->project = $args["project"] ?? '';
        $this->url = $args["url"] ?? '';
        $this->userId = $args["userId"] ?? '';
        $this->tags = $args["tags"] ?? '';
    }

    public function validateProject()
    {
        if (!$this->project) {
            self::$alerts["error"][] = "Tienes que añadir un nombre para el proyecto.";
        }

        if (strlen($this->project) > 25) {
            self::$alerts["error"][] = "El nombre del proyecto no puede ser mayor a 25 caracteres";
        }

        if (strlen($this->project) < 5) {
            self::$alerts["error"][] = "El nombre del proyecto debe ocupar al menos 5 caracteres";
        }

        return self::$alerts;
    }

    public static function getProjectsWithTags($userId)
    {
        $projects = Project::belongsTo("userId", $userId);

        foreach ($projects as &$project) {
            $etiquetas = $project->tags;
            $tags = preg_split('/(?=[A-Z])/', $etiquetas, -1, PREG_SPLIT_NO_EMPTY);
            $project->tags = $tags; // Replace the String for array with the tags separated
        }

        return $projects;
    }

    public function joinTags($array)
    {

        if (empty($array)) {
            self::$alerts["error"][] = "Debe haber al menos una etiqueta";

            return;
        }

        if (!empty($array)) {
            if (count($array) > 3) {
                self::$alerts["error"][] = "No puede haber mas de 3 etiquetas";
            }
        }

        $result = "";
        foreach ($array as $elemento) {
            switch ($elemento) {
                case 1:
                    $result .= 'Deportes';
                    break;
                case 2:
                    $result .= 'Educacion';
                    break;
                case 3:
                    $result .= 'Viajes';
                    break;
                case 4:
                    $result .= 'Personal';
                    break;
                case 5:
                    $result .= 'Otro';
                    break;
                default:
                    break;
            }
        }
        
        $this->tags = $result;
    }
}
