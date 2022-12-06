<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Inventory\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvSupplier
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $cperson
 * @property string $contact
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|InvBo[] $inv_bos
 * @property Collection|InvItem[] $inv_items
 * @property Collection|InvPo[] $inv_pos
 * @property Collection|InvReturn[] $inv_returns
 *
 * @package Modules\Inventory\Http\Models
 */
class InvSupplier extends Model
{
	protected $table = 'inv_suppliers';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'address',
		'cperson',
		'contact',
		'status'
	];

	public function inv_bos()
	{
		return $this->hasMany(InvBo::class, 'supplier_id');
	}

	public function inv_items()
	{
		return $this->hasMany(InvItem::class, 'supplier_id');
	}

	public function inv_pos()
	{
		return $this->hasMany(InvPo::class, 'supplier_id');
	}

	public function inv_returns()
	{
		return $this->hasMany(InvReturn::class, 'supplier_id');
	}
}
