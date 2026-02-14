<?php

    use CodeIgniter\Router\RouteCollection;
    use App\Controllers\students_ojt\Dashboard;

    /**
     * @var RouteCollection $routes
    */

    $routes->get('/', 'Home::index');
    $routes->post("login/auth", to: "Login::auth");
    $routes->get("students_ojt/mainview" , "students_ojt\Mainview::index");

    // --- Content Load Students Ojt ---
    $routes->get('students_ojt/dashboard', 'Students::dashboard');
    $routes->get('students_ojt/attendance', 'Students::attendance');
    $routes->get('students_ojt/report', 'Students::report');


