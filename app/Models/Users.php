<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class Users extends Model 
    {
        protected $table = "users";
        protected $primaryKey = "userId";
        
        protected $allowedFields = ["username", "password"];

    }