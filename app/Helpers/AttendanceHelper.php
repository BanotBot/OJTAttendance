<?php

class AttendanceHelper
{

    public static function get_status($status)
    {
        switch($status) {
            case 3: {
                return "PRESENT";
            }

            case 4: {
                return "ABSENT";
            }

            case 5: {
                return "TIME-IN";
            }

            default: {
                throw new Error("Illegal attendance status");
            }
        }
    }


    public static function get_time_12Hour_format($time)
    {
        return date("h:i:s A", strtotime($time));
    }
}