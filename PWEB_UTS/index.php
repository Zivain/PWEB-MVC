<?php
// index.php

$controller = $_GET['controller'] ?? 'login';
$action     = $_GET['action'] ?? 'index';

$controllerFile = __DIR__ . "/Controller/" . ucfirst($controller) . "Controller.php";

if(file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";
    $controllerObj = new $className();

    if(method_exists($controllerObj, $action)){
        $controllerObj->$action();
    } else {
        echo "Action '$action' tidak ditemukan!";
    }
} else {
    echo "Controller '$controller' tidak ditemukan!";
}
