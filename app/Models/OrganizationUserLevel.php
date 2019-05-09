<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class OrganizationUserLevel
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $organization_users
 *
 * @package App\Models
 */
class OrganizationUserLevel extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function organization_users()
	{
		return $this->hasMany(\App\Models\OrganizationUser::class, 'level_id');
	}
}
