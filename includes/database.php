<?php

$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME'];

try {
    
    $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $db->set_charset("utf8");
} catch (Exception $exception) {
    echo "Error 404";
    exit;
}
