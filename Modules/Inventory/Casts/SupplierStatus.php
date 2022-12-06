<?php
namespace Modules\Inventory\Casts;

class SupplierStatus
{
    public const ACTIVE = 1;
    public const INACTIVE = 0;

    public static function lang($status): string
    {
        switch ($status){
            case self::ACTIVE :
                return "ACTIVE";
            case self::INACTIVE :
                return "INACTIVE";
            default :
                return "Unidentified";
        }
    }
}
