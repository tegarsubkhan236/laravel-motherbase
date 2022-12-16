<?php
namespace Modules\Inventory\Casts;

class StockType
{
    public const IN = 1;
    public const OUT = 2;
    public const ADJUSMENT_MIN = 3;
    public const ADJUSMENT_PLUS = 4;

    public static function lang($type): string
    {
        switch ($type){
            case self::IN :
                return "IN";
            case self::OUT :
                return "OUT";
            case self::ADJUSMENT_MIN :
                return "ADJUSMENT_MIN";
            case self::ADJUSMENT_PLUS :
                return "ADJUSMENT_PLUS";
            default :
                return "Unidentified";
        }
    }
}
