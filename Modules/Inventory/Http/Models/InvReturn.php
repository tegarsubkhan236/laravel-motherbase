<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvReturn
 * 
 * @property int $id
 * @property int $supplier_id
 * @property string $return_code
 * @property string|null $remarks
 * @property string $stock_ids
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property InvSupplier $inv_supplier
 *
 * @package Modules\Inventory\Http\Models
 */
class InvReturn extends Model
{
	protected $table = 'inv_returns';

	protected $casts = [
		'supplier_id' => 'int'
	];

	protected $fillable = [
		'supplier_id',
		'return_code',
		'remarks',
		'stock_ids'
	];

	public function inv_supplier()
	{
		return $this->belongsTo(InvSupplier::class, 'supplier_id');
	}
}
