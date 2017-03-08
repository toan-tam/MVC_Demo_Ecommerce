<?php

function dd($data){

    echo "<pre>";
    die(var_dump($data));
    echo "</pre>";
}

function redirect($location){
    header("location:" . $location);
    exit();
}

function redirectWithMessageSession($location, $message = null){
    $_SESSION['message'] = $message;
    header("location:" . $location);
    exit();
}


function redirectWithErrorSession($location, $message){
    $_SESSION['error'] = $message;
    header("location:" . $location);
    exit();
}

function route($controller="pages", $action = "home", $role=""){
    return ($role == "admin" ? "?role=admin&" : "?") . "controller=$controller&action=$action";
}