<?php
/**
 * Created by Reliese Model.
 * Date: Sat, 11 May 2019 14:50:03 +0700.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use App\Traits\UsesUuidTrait;
/**
 * Class DocumentProject
 * 
 * @property string $id
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
 * @property \App\Models\DocumentProjectCategory $document_project_category
 * @property \App\Models\Organization $organization
 * @property \Illuminate\Database\Eloquent\Collection $documents
 *
 * @package App\Models
 */
class DocumentProject extends Eloquent
{
	use UsesUuidTrait;
	
	public $incrementing = false;
	protected $keyType = 'string';
	
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

	public function document_project_category()
	{
		return $this->belongsTo(\App\Models\DocumentProjectCategory::class, 'category_id');
	}

	public function organization()
	{
		return $this->belongsTo(\App\Models\Organization::class);
	}

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class, 'project_id');
	}
}
