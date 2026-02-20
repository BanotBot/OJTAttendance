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
    $routes->get("students_ojt/mainview" , "students_ojt\Mainview::index");

    // --- Content Load Students Ojt -> UI ---
    $routes->get("students_ojt/dashboard", "Students::dashboard");
    $routes->get("students_ojt/attendance", "Students::attendance");
    $routes->get("students_ojt/report", "Students::report");

    // --- Attendance Upload Routes ---
    $routes->post("saveAttendance", "students_ojt\AttendanceController::saveAttendance");
    $routes->get("attendances" , "students_ojt\AttendanceController::fetchAllAttendance");

    // --- PDF Routes ---
    $routes->get("attendances/pdf", "students\AttendanceController::exportAttendance");


