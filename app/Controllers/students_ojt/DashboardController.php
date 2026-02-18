<?php

    namespace App\Controllers\students_ojt;
    use App\Controllers\BaseController;

    class DashboardController extends BaseController
    {
        public function index()
        {
            return view("students_ojt/dashboard");
        }

        
    }