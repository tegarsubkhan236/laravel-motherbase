<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvSale
 * 
 * @property int $id
 * @property string $sales_code
 * @property string|null $client
 * @property float $amount
 * @property string|null $remarks
 * @property string $stock_ids
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package Modules\Inventory\Http\Models
 */
class InvSale extends Model
{
	protected $table = 'inv_sales';

	protected $casts = [
		'amount' => 'float'
	];

	protected $fillable = [
		'sales_code',
		'client',
		'amount',
		'remarks',
		'stock_ids'
	];
}
