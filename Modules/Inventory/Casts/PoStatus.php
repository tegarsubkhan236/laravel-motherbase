<?php
namespace Modules\Inventory\Casts;

class PoStatus
{
    public const CREATED = 1;
    public const FULL_RECEVIVE = 1;
    public const PARTIAL_RECEIVE = 1;
    public const FAILED = 0;

    public static function lang($status): string
    {
        switch ($status){
            case self::CREATED :
                return "CREATED";
            case self::FULL_RECEVIVE :
                return "FULL_RECEVIVE";
            case self::PARTIAL_RECEIVE :
                return "PARTIAL_RECEIVE";
            case self::FAILED :
                return "FAILED";
            default :
                return "Unidentified";
        }
    }

    public static function lang_code($status): string
    {
        switch ($status){
            case self::CREATED :
                return "CR";
            case self::FULL_RECEVIVE :
                return "FR";
            case self::PARTIAL_RECEIVE :
                return "PR";
            case self::FAILED :
                return "F";
            default :
                return "Unidentified";
        }
    }
}
