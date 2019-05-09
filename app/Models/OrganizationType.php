<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class OrganizationType
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $organizations
 *
 * @package App\Models
 */
class OrganizationType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function organizations()
	{
		return $this->hasMany(\App\Models\Organization::class, 'type_id');
	}
}
