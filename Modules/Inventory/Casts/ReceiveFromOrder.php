<?php
namespace Modules\Inventory\Casts;

class ReceiveFromOrder
{
    public const PO = 1;
    public const BO = 2;

    public static function lang($type): string
    {
        switch ($type){
            case self::PO :
                return "PURCHASE ORDER";
            case self::BO :
                return "BACK ORDER";
            default :
                return "Unidentified";
        }
    }
}
