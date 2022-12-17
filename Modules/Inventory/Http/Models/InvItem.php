<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvItem
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $name
 * @property string $unit
 * @property string $description
 * @property int $cost
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property InvSupplier $inv_supplier
 * @property InvBoItem $inv_bo_item
 * @property InvPoItem $inv_po_item
 * @property Collection|InvStock[] $inv_stocks
 *
 * @package Modules\Inventory\Http\Models
 */
class InvItem extends Model
{
	protected $table = 'inv_items';

	protected $casts = [
		'supplier_id' => 'int',
		'cost' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'supplier_id',
		'name',
		'unit',
		'description',
		'cost',
		'status'
	];

	public function inv_supplier()
	{
		return $this->belongsTo(InvSupplier::class, 'supplier_id');
	}

	public function inv_bo_item()
	{
		return $this->hasOne(InvBoItem::class, 'item_id');
	}

	public function inv_po_item()
	{
		return $this->hasOne(InvPoItem::class, 'item_id');
	}

	public function inv_stocks()
	{
		return $this->hasMany(InvStock::class, 'item_id');
	}
}
