<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Organization
 * 
 * @property int $id
 * @property int $type_id
 * @property int $category_id
 * @property string $name
 * @property string $name_en
 * @property string $description
 * @property string $slogan
 * @property string $logo_path
 * @property \Carbon\Carbon $expired_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\OrganizationCategory $organization_category
 * @property \App\Models\OrganizationType $organization_type
 * @property \Illuminate\Database\Eloquent\Collection $documents
 * @property \Illuminate\Database\Eloquent\Collection $budgets
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Organization extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'type_id' => 'int',
		'category_id' => 'int'
	];

	protected $dates = [
		'expired_at'
	];

	protected $fillable = [
		'type_id',
		'category_id',
		'name',
		'name_en',
		'description',
		'slogan',
		'logo_path',
		'expired_at'
	];

	public function organization_category()
	{
		return $this->belongsTo(\App\Models\OrganizationCategory::class, 'category_id');
	}

	public function organization_type()
	{
		return $this->belongsTo(\App\Models\OrganizationType::class, 'type_id');
	}

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class);
	}

	public function budgets()
	{
		return $this->belongsToMany(\App\Models\Budget::class, 'organization_budget')
					->withPivot('id', 'amount', 'remaining_amount')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('id', 'level_id')
					->withTimestamps();
	}
}