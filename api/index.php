<?php

session_start();

require "configs/routes.php";

define ("APP_FOLDER", "/Tema_finala/api/");

$currentRoute = str_replace(APP_FOLDER, "", $_SERVER["REDIRECT_URL"]);

//IF GET ONE OF A CERTAIN ID, GET ID FROM URL
function get_url_segments($route) {
    return explode('/', $route);
}

$routeSections = get_url_segments($currentRoute);
$sectionsLength = count($routeSections);
$articleUrlId = null;

if (is_numeric($routeSections[2])) {
    $articleUrlId = $routeSections[2];
    array_pop($routeSections);
    $currentRoute = implode('/', $routeSections);
    $currentRoute .= '/:d';
}

//IF CURRENT ROUTE EXISTS
if (!empty($currentRoute)) {
    if (array_key_exists($currentRoute, $routes)) {
        $class = $routes[$currentRoute]["class"];
        $method = $routes[$currentRoute]["method"];
        
        require "controllers/".$class.".php";
        $controller = new $class();
        if (isset($articleUrlId)) {
            $response = $controller->$method($articleUrlId);
        } else {
            $response = $controller->$method();
        };
        
        header("Content-Type: application/json");
        echo json_encode($response);
        
    } else {
        http_response_code(404);
        echo "PAGE NOT FOUND!";
    }
} else {
    http_response_code(403);
    echo "ACCESS FORBIDDEN!";
}

?>