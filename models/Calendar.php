<?php

namespace Model;

class Calendar extends ActiveRecord{

    protected static $table = "calendar";
    protected static $dbColumns = ["userId", "projectId", "weekDay", "hours"];

    public $userId;
    public $projectId;
    public $weekDay;
    public $hours;
    
    public function __construct($args = [])
    {
        $this->userId = $args["userId"] ?? '';
        $this->projectId = $args["projectId"] ?? '';
        $this->weekDay = $args["weekDay"] ?? '';
        $this->hours = $args["hours"] ?? '';
    }

    public function validateCalendar($calendarFull){

        $validWeekDays = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo"];

        if(!$this->userId || !$this->projectId || !$this->weekDay || !$this->hours || $this->userId !== $_SESSION["id"]){
            self::$alerts["error"][] = "Error al agregar al calendario, intentelo de nuevo más tarde";
        }

        if(!in_array($this->weekDay, $validWeekDays)){
            self::$alerts["error"][] = "Error al elegir el día, intentelo de nuevo más tarde";
        }

        if(count($calendarFull) >= 3){
            self::$alerts["error"][] = "No se pueden añadir más de 3 proyectos por día";
        }

        return self::$alerts;
    }
}