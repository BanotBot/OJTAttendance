<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\students_ojt\Dashboard;

/**
 * @var RouteCollection $routes
*/

$routes->get('/', 'Home::index');
$routes->post("login/auth", to: "Login::auth");
$routes->get("students_ojt/dashboard" , "students_ojt\Dashboard::index");

