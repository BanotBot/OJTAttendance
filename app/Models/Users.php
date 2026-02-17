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

        public const STATUS_ACTIVE = 1;
        public const STATUS_INACTIVE = 2;
        public const STATUS_SUSPENDED = 3;
        
        protected $allowedFields = [
            "userId",
            "firstName",
            "middleName",
            "lastName",
            "address",
            "contactNumber",
            "status"
        ];
        
    }