<?php 
// Conectarnos a la base de datos
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

try{
    ActiveRecord::setDB($db);
} catch(Exception $exception){
    echo "Error 404";
    exit;
}
