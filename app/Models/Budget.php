<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use App\Traits\UsesUuidTrait;

/**
 * Class Budget
 * 
 * @property string $id
 * @property \Carbon\Carbon $edu_year
 * @property float $amount
 * @property float $remaining_amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $organizations
 *
 * @package App\Models
 */
class Budget extends Eloquent
{
	use UsesUuidTrait;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $casts = [
		'amount' => 'float',
		'remaining_amount' => 'float'
	];

	protected $dates = [
		'edu_year'
	];

	protected $fillable = [
		'edu_year',
		'amount'
	];

	public function organizations()
	{
		return $this->belongsToMany(\App\Models\Organization::class, 'organization_budget')
					->using(\App\Models\OrganizationBudget::class)
					->as('budget_histories')
					->withPivot('amount', 'remaining_amount')
					->withTimestamps();
	}
}
