<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('api', ['controller' => 'ApiController']);


$routes->get('/hello', 'Test::hello');
$routes->get('/hello', 'Test::hello');
$routes->get('/about', 'Test::about');
$routes->get('/contact', 'Test::contact');

