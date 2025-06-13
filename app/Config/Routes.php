<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AppInit::index');
$routes->resource('api', ['controller' => 'ApiController']);


$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');



$routes->get('/inscription', 'Home::inscription');
$routes->post('/inscription', 'Home::inscriptionPost');
