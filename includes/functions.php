<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Function for sanitize
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Function for check if user is auth
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

//Function for validate urls
function validateCustomUrl($url) {
    $pattern = '/^[a-f0-9]{32}$/i';
    return preg_match($pattern, $url) === 1;
}