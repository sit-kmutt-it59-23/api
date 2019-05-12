<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 11 May 2019 14:50:03 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot as Eloquent;

/**
 * Class DocumentProject
 * 
 * @property int $id
 * @property int $organization_id
 * @property int $category_id
 * @property string $name
 * @property string $name_en
 * @property float $budget_amount
 * @property \Carbon\Carbon $start_at
 * @property \Carbon\Carbon $end_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $documents
 *
 * @package App\Models
 */
class DocumentProject extends Eloquent
{
	protected $increments = true;

	protected $casts = [
		'organization_id' => 'int',
		'category_id' => 'int',
		'budget_amount' => 'float'
	];

	protected $dates = [
		'start_at',
		'end_at'
	];

	protected $fillable = [
		'organization_id',
		'category_id',
		'name',
		'name_en',
		'budget_amount',
		'start_at',
		'end_at'
	];

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class, 'project_id');
	}
}
