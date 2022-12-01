<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission as BasePermission;

/**
 * Class Permission
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Permission|null $parent
 * @property Collection|ModelHasPermission[] $model_has_permissions
 * @property Collection|Permission[] $children
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permission extends BasePermission
{
	protected $table = 'permissions';

	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'name',
		'guard_name'
	];

	public function parent(): BelongsTo
    {
		return $this->belongsTo(Permission::class, 'parent_id');
	}

	public function model_has_permissions(): HasMany
    {
		return $this->hasMany(ModelHasPermission::class);
	}

	public function children(): HasMany
    {
		return $this->hasMany(Permission::class, 'parent_id');
	}

	public function roles(): BelongsToMany
    {
		return $this->belongsToMany(Role::class, 'role_has_permissions');
	}
}
