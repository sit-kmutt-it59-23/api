<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class OrganizationCategory
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $organizations
 *
 * @package App\Models
 */
class OrganizationCategory extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function organizations()
	{
		return $this->hasMany(\App\Models\Organization::class, 'category_id');
	}
}
