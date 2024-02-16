<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login');

$routes->group("api", ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->post("register", "Auth::register");
    $routes->post("login", "Auth::login");
    $routes->post("logout", "Auth::logout");
    $routes->get("users", "Auth::user", ['filter' => 'authFilter']);
    $routes->get("users/email", "Auth::getUserByEmail", ['filter' => 'authFilter']);
});

$routes->group('p', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
    $routes->get('dash', 'Home::dashboard');
    $routes->get('agent', 'Home::agent');
    $routes->get('hotel', 'Home::hotel');
    $routes->get('room', 'Home::room');
    $routes->get('rekening', 'Home::rekening');
    $routes->get('booking', 'Home::booking');
    $routes->get('payment', 'Home::payment');
});
// Add route for AgentController with filter
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function (RouteCollection $routes) {
    $routes->resource('agents', ['controller' => 'AgentController', 'filter' => 'authFilter']);
    // Change the method from PUT to POST for the update route
    $routes->post('agents/(:num)', 'AgentController::update/$1');
});
