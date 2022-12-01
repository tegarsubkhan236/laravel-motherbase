<?php
namespace App\Casts;

class UserRole
{
    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const USER = 3;

    public static function lang($status): string
    {
        switch ($status){
            case self::SUPER_ADMIN :
                return "SUPER_ADMIN";
            case self::ADMIN :
                return "ADMIN";
            case self::USER :
                return "USER";
            default :
                return "Unidentified";
        }
    }
}
