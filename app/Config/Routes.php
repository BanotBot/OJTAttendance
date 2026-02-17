<?php

    use CodeIgniter\Router\RouteCollection;

    /**
     * @var RouteCollection $routes
     * 
    */

    $routes->get("/", "Home::index");
    $routes->post("login/auth", to: "Login::auth");
    $routes->get("register", "Register::index");
    $routes->post("register/auth", "Register::auth");
    $routes->get("students_ojt/mainview" , "students_ojt/Mainview::index");

    // --- Content Load Students Ojt -> UI ---
    $routes->get("students_ojt/dashboard", "Students::dashboard");
    $routes->get("students_ojt/attendance", "Students::attendance");
    $routes->get("students_ojt/report", "Students::report");

    // --- Attendance Upload Routes ---
    $routes->post("students_ojt/attendance", "students_ojt/Attendance::saveAttendance");


