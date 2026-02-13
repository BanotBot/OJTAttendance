<?php

    namespace App\Controllers\students_ojt;
    use App\Controllers\BaseController;

    class Dashboard extends BaseController
    {
        public function index()
        {
            return view("students_ojt/Dashboard");
        }

        
    }