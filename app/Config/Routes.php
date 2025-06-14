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
$routes->post('/retrieving_new_task', 'Home::retrieving_new_task');
$routes->post('/delete', 'Home::delete_task');
$routes->post('/tasks/status', 'Home::change_task_status');

$routes->get('/accueil', 'Home::Accueil');

