<?php

namespace App\Models;
use CodeIgniter\Model;

class OjtStudentsModel extends Model
{
    protected $table = "ojt_students";
    protected $primaryKey = "ojtId";

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

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