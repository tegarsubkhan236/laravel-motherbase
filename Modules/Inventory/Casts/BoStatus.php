<?php
namespace Modules\Inventory\Casts;

class BoStatus
{
    public const CREATED = 1;
    public const FULL_RECEIVE = 2;
    public const PARTIAL_RECEIVE = 3;
    public const FAILED = 0;

    public static function lang($status): string
    {
        switch ($status){
            case self::CREATED :
                return "CREATED";
            case self::FULL_RECEIVE :
                return "FULL_RECEIVE";
            case self::PARTIAL_RECEIVE :
                return "PARTIAL_RECEIVE";
            case self::FAILED :
                return "FAILED";
            default :
                return "Unidentified";
        }
    }
}
