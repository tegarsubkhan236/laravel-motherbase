<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvPo
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $po_code
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
 * @property Collection|InvBo[] $inv_bos
 * @property InvPoItem $inv_po_item
 *
 * @package Modules\Inventory\Http\Models
 */
class InvPo extends Model
{
	protected $table = 'inv_po';

	protected $casts = [
		'supplier_id' => 'int',
		'amount' => 'float',
		'discount_perc' => 'float',
		'discount' => 'float',
		'tax_perc' => 'float',
		'tax' => 'float',
		'status' => 'int'
	];

	protected $fillable = [
		'supplier_id',
		'po_code',
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

	public function inv_bos()
	{
		return $this->hasMany(InvBo::class, 'po_id');
	}

	public function inv_po_item()
	{
		return $this->hasMany(InvPoItem::class, 'po_id');
	}
}
