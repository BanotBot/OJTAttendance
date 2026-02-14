<?php

    namespace App\Controllers;
    use App\Controllers\BaseController;

    class Students extends BaseController
    {
    
        public function dashboard()
        {
            return view("students_ojt/dashboard");
        }

        public function attendance()
        {
            return view("students_ojt/attendance");
        }

        public function report() 
        {
            return view("students_ojt/report");
        }

        
    }