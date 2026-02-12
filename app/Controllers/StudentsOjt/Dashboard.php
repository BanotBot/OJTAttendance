<?php

use App\Controllers\BaseController;

    class Dashboard extends BaseController
    {
        public function index()
        {
            return view("StudentsOjt/Dashboard");
        }

        
    }