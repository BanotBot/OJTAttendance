<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class Users extends Model 
    {
        protected $table = "users";
        protected $primaryKey = "userId";
        
        protected $allowedFields = ["username", "password"];

    }

    class OjtStudents extends Model 
    {
        protected $table = "ojt_students";
        protected $primaryKey = "ojtId";

        protected $allowedFields = [
            "userId",
            "firstName",
            "middleName",
            "lastName",
            "address",
            "contactNumber"
        ];

        
    }