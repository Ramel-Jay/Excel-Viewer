<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('auth/login', 'Auth::index');
$routes->get('/auth/register', 'Auth::register');
$routes->post('auth/registerUser', 'Auth::registerUser');
$routes->post('auth/loginUser', 'Auth::loginUser');
$routes->get('dashboard', 'Dashboard::index'); 
$routes->get('dashboard/signout', 'Dashboard::signOut');
$routes->post('dashboard/excel', 'Dashboard::excelUpload');