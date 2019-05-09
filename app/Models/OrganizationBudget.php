<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class OrganizationBudget
 * 
 * @property int $id
 * @property int $organization_id
 * @property int $budget_id
 * @property float $amount
 * @property float $remaining_amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Budget $budget
 * @property \App\Models\Organization $organization
 *
 * @package App\Models
 */
class OrganizationBudget extends Eloquent
{
	protected $table = 'organization_budget';

	protected $casts = [
		'organization_id' => 'int',
		'budget_id' => 'int',
		'amount' => 'float',
		'remaining_amount' => 'float'
	];

	protected $fillable = [
		'organization_id',
		'budget_id',
		'amount',
		'remaining_amount'
	];

	public function budget()
	{
		return $this->belongsTo(\App\Models\Budget::class);
	}

	public function organization()
	{
		return $this->belongsTo(\App\Models\Organization::class);
	}
}
