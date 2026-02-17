<?php

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
                                "userId",
                                "status"
                            ], $userId, OjtStudents::STATUS_ACTIVE)
                        ->first();

            return $ojtId;
        }
    }