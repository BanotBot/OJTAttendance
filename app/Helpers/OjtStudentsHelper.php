<?php

namespace App\Helpers;
use App\Models\OjtStudents;
use App\Models\Users;

class OjtStudentsHelper
{
    public static function getOjtId($userId)
    {
        $usersModel = new Users();
        $ojtId = $usersModel
            ->select("ojtId")
            ->where(
                [
                    "userId" => $userId,
                    "status" => OjtStudents::STATUS_ACTIVE
                ]
            )
            ->first();

        return $ojtId["ojtId"] ??  null;
    }
}