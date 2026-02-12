<?php

use CodeIgniter\Model;


    class Users extends Model 
    {
        protected $tableUsers = "users";
        protected $primaryKey = "userId";
        
        protected $allowedFields = ["username", "password"];

    }