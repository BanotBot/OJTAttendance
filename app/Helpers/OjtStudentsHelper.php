<?php

namespace App\Helpers;
use App\Models\OjtStudentsModel;

class OjtStudentsHelper
{
    public static function getOjtId($userId)
    {

        $ojtStudentsModel = new OjtStudentsModel();
        $ojtId = $ojtStudentsModel
            ->select("ojtId")
            ->where(
                [
                    "userId" => $userId,
                    "status" => OjtStudentsModel::STATUS_ACTIVE
                ]
            )
            ->first();

        return $ojtId["ojtId"] ?? null;
    }
}