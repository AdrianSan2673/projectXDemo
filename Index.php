<?php
//session_set_cookie_params(60*60*24);
session_start();
require_once 'autoload.php';
require_once 'config/Connection.php';
require_once 'helpers/Utils.php';
require_once 'config/parameters.php';
require_once 'helpers/Encryption.php';

setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Mexico_City');
ini_set('memory_limit', '-1');

function show_error(){
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $controller_name = $_GET['controller'].'Controller';
}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller_name = controller_default;
}else{
    show_error();
    exit();
}

if (class_exists($controller_name)) {
    $controller = new $controller_name();
    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    }elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controller->$action_default();
    }else {
        show_error();
    }
}else{
    show_error();
}

if (isset($_SESSION['identity'])) {
    if ($_SESSION['identity']->id == 3460 || $_SESSION['identity']->id == 3095 || $_SESSION['identity']->id == 3484 || $_SESSION['identity']->id == 3633 || $_SESSION['identity']->id == 2883 || $_SESSION['identity']->id == 3028 || $_SESSION['identity']->id == 3181 || $_SESSION['identity']->id == 3010 || $_SESSION['identity']->id == 3188 || $_SESSION['identity']->id == 4034 || $_SESSION['identity']->id == 3474 || $_SESSION['identity']->id == 3537 || $_SESSION['identity']->id == 3538) {
        unset($_SESSION['identity']);
    }
}
