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

        $validWeekDaysAndCount = [
            "Lunes" => 0,
            "Martes" => 0,
            "Miercoles" => 0,
            "Jueves" => 0,
            "Viernes" => 0,
            "Sabado" => 0,
            "Domingo" => 0
        ];
        $days = array_keys($validWeekDaysAndCount);

        //Check if the day has more than 3 entries
        foreach ($calendarFull as $value){
            if(in_array($value->weekDay, $days)){
                $lastValue = $validWeekDaysAndCount[$value->weekDay];
                $validWeekDaysAndCount[$value->weekDay] = $lastValue += 1;
            }
        }

        if(!$this->userId || !$this->projectId || !$this->weekDay || !$this->hours || $this->userId !== $_SESSION["id"]){
            self::$alerts["error"][] = "Error al agregar al calendario, intentelo de nuevo más tarde";
        }

        if(!in_array($this->weekDay, $days)){
            self::$alerts["error"][] = "Error al elegir el día, intentelo de nuevo más tarde";
        }

        if($validWeekDaysAndCount[$this->weekDay] >= 3){
            self::$alerts["error"][] = "No se pueden añadir más de 3 proyectos al mismo día";
        }

        return self::$alerts;
    }
}