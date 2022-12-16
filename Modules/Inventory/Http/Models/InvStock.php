<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvStock
 *
 * @property int $id
 * @property int $item_id
 * @property int $quantity
 * @property string $unit
 * @property float $price
 * @property float $total
 * @property int $type
 * @property Carbon|null $created_at
 *
 * @property InvItem $inv_item
 *
 * @package Modules\Inventory\Http\Models
 */
class InvStock extends Model
{
    protected $table = 'inv_stocks';
    public $timestamps = false;

    protected $casts = [
        'item_id' => 'int',
        'quantity' => 'int',
        'price' => 'float',
        'total' => 'float',
        'type' => 'int'
    ];

    protected $fillable = [
        'item_id',
        'quantity',
        'unit',
        'price',
        'total',
        'type'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function inv_item()
    {
        return $this->belongsTo(InvItem::class, 'item_id');
    }
}
