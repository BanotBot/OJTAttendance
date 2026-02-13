<?php

    namespace App\Controllers\Students_ojt;
    use App\Controllers\BaseController;

    class Mainview extends BaseController
    {

        public function index() 
        {
            return view("students_ojt/mainview");
        }

    }