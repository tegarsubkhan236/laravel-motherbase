<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvReceiving
 * 
 * @property int $id
 * @property int $from_id
 * @property string $from_order
 * @property float $amount
 * @property float|null $discount_perc
 * @property float|null $discount
 * @property float|null $tax_perc
 * @property float|null $tax
 * @property string $stock_ids
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|InvBo[] $inv_bos
 *
 * @package Modules\Inventory\Http\Models
 */
class InvReceiving extends Model
{
	protected $table = 'inv_receivings';

	protected $casts = [
		'from_id' => 'int',
		'amount' => 'float',
		'discount_perc' => 'float',
		'discount' => 'float',
		'tax_perc' => 'float',
		'tax' => 'float'
	];

	protected $fillable = [
		'from_id',
		'from_order',
		'amount',
		'discount_perc',
		'discount',
		'tax_perc',
		'tax',
		'stock_ids',
		'description'
	];

	public function inv_bos()
	{
		return $this->hasMany(InvBo::class, 'receiving_id');
	}
}
