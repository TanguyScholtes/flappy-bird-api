<?php

$routes = require 'configs/routes.php';
$default_route = $routes[ 'default' ];
$route_parts = explode( '/', $default_route );

$method = $_SERVER[ 'REQUEST_METHOD' ];

// Allow CORS
header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Methods: GET,POST' );
header( 'Access-Control-Allow-Headers: X-Requested-With' );
if ( $method === 'OPTIONS' ) {
    http_response_code( 200 );
    die();
}

if ( $method != 'GET' && $method != 'POST' ) {
    die( json_encode( [ 'error' => $method . 'n\'est pas une méthode autorisée sur ce serveur.' ] ) );
}


$ressource = $_REQUEST[ 'ressource' ] ?? $route_parts[ 1 ];
$action = $_REQUEST[ 'action' ] ?? $route_parts[ 2 ];

if ( !in_array( $method . '/' . $ressource . '/' . $action, $routes ) ) {
    die( 'Unauthorized action ' . $action . ' on ressource ' . $ressource . ' with method ' . $method . '.' );
}

$controllerName = 'Controllers\\' . ucfirst( $ressource );

$controller = new $controllerName();
$data = call_user_func( [ $controller, $action ] );

//DEV DISPLAY - ERASE WHEN FULL VIEW TEMPLATING IS IMPLEMENTED
echo jsonEncode( $data );
