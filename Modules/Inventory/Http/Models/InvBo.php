<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvBo
 * 
 * @property int $id
 * @property int $receiving_id
 * @property int $po_id
 * @property int $supplier_id
 * @property string $bo_code
 * @property float $amount
 * @property float|null $discount_perc
 * @property float|null $discount
 * @property float|null $tax_perc
 * @property float|null $tax
 * @property string|null $remarks
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property InvSupplier $inv_supplier
 * @property InvPo $inv_po
 * @property InvReceiving $inv_receiving
 * @property InvBoItem $inv_bo_item
 *
 * @package Modules\Inventory\Http\Models
 */
class InvBo extends Model
{
	protected $table = 'inv_bo';

	protected $casts = [
		'receiving_id' => 'int',
		'po_id' => 'int',
		'supplier_id' => 'int',
		'amount' => 'float',
		'discount_perc' => 'float',
		'discount' => 'float',
		'tax_perc' => 'float',
		'tax' => 'float',
		'status' => 'int'
	];

	protected $fillable = [
		'receiving_id',
		'po_id',
		'supplier_id',
		'bo_code',
		'amount',
		'discount_perc',
		'discount',
		'tax_perc',
		'tax',
		'remarks',
		'status'
	];

	public function inv_supplier()
	{
		return $this->belongsTo(InvSupplier::class, 'supplier_id');
	}

	public function inv_po()
	{
		return $this->belongsTo(InvPo::class, 'po_id');
	}

	public function inv_receiving()
	{
		return $this->belongsTo(InvReceiving::class, 'receiving_id');
	}

	public function inv_bo_item()
	{
		return $this->hasOne(InvBoItem::class, 'bo_id');
	}
}
