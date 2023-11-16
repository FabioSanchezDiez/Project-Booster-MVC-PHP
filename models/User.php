<?php

namespace Model;

class User extends ActiveRecord{
    protected static $table = "users";
    protected static $dbColumns = ["id", "name", "email", "password", "token", "confirmed"];

    public $id;
    public $name;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmed;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? '';
        $this->email = $args["email"] ?? '';
        $this->password = $args["password"] ?? '';
        $this->password2 = $args["password2"] ?? '';
        $this->token = $args["token"] ?? '';
        $this->confirmed = $args["confirmed"] ?? 0;
        
    }

    //Validate login of users
    public function validateLogin(){
        if(!$this->email){
            self::$alerts["error"][] = "El email es obligatorio";
        }

        if(strlen($this->email) >= 50){
            self::$alerts["error"][] = "El email no puede ser mayor a 50 caracteres";
        }

        if(!$this->password){
            self::$alerts["error"][] = "La contraseña es obligatoria";
        }

        if(strlen($this->password) >= 60){
            self::$alerts["error"][] = "La contraseña no puede ser mayor a 60 caracteres";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts["error"][] = "Email no válido";
        }

        return self::$alerts;
    }

    //Method for validate new accounts
    public function validateNewAccount(){
        if(!$this->name){
            self::$alerts["error"][] = "El nombre de usuario es obligatorio";
        }

        if(strlen($this->name) >= 30){
            self::$alerts["error"][] = "El nombre de usuario no puede ser mayor a 30 caracteres";
        }

        if(!$this->email){
            self::$alerts["error"][] = "El email es obligatorio";
        }

        if(strlen($this->email) >= 50){
            self::$alerts["error"][] = "El email no puede ser mayor a 50 caracteres";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts["error"][] = "Email no válido";
        }

        if(!$this->password){
            self::$alerts["error"][] = "La contraseña es obligatoria";
        }

        if(strlen($this->password) < 6){
            self::$alerts["error"][] = "La contraseña debe contener al menos 6 caracteres";
        }

        if(strlen($this->password) >= 60){
            self::$alerts["error"][] = "La contraseña no puede ser mayor a 60 caracteres";
        }

        if($this->password !== $this->password2){
            self::$alerts["error"][] = "Las contraseñas tienen que ser identicas";
        }

        return self::$alerts;
    }

    public function validateEmail(){
        if(!$this->email){
            self::$alerts["error"][] = "El email es obligatorio";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts["error"][] = "Email no válido";
        }

        if(strlen($this->email) >= 50){
            self::$alerts["error"][] = "El email no puede ser mayor a 50 caracteres";
        }

        return self::$alerts;

    }

    public function validatePassword(){
        if(!$this->password){
            self::$alerts["error"][] = "La contraseña es obligatoria";
        }

        if(strlen($this->password) < 6){
            self::$alerts["error"][] = "La contraseña debe contener al menos 6 caracteres";
        }

        if(strlen($this->password) >= 60){
            self::$alerts["error"][] = "La contraseña no puede ser mayor a 60 caracteres";
        }

        return self::$alerts;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Generate token
    public function createToken(){
        $this->token = uniqid();
    }
}