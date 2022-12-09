<?php
namespace Modules\Inventory\Casts;

class StockType
{
    public const IN = 1;
    public const OUT = 2;

    public static function lang($type): string
    {
        switch ($type){
            case self::IN :
                return "IN";
            case self::OUT :
                return "OUT";
            default :
                return "Unidentified";
        }
    }
}
