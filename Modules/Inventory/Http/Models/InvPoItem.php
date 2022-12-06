<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvPoItem
 * 
 * @property int $po_id
 * @property int $item_id
 * @property int $quantity
 * @property float $price
 * @property string|null $unit
 * @property float $total
 * 
 * @property InvPo $inv_po
 * @property InvItem $inv_item
 *
 * @package Modules\Inventory\Http\Models
 */
class InvPoItem extends Model
{
	protected $table = 'inv_po_items';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'po_id' => 'int',
		'item_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'po_id',
		'item_id',
		'quantity',
		'price',
		'unit',
		'total'
	];

	public function inv_po()
	{
		return $this->belongsTo(InvPo::class, 'po_id');
	}

	public function inv_item()
	{
		return $this->belongsTo(InvItem::class, 'item_id');
	}
}
