<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 11 May 2019 14:52:57 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentProjectCategory
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $organizations
 *
 * @package App\Models
 */
class DocumentProjectCategory extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description'
	];

	public function organizations()
	{
		return $this->belongsToMany(\App\Models\Organization::class, 'document_projects', 'category_id')
					->using(\App\Models\DocumentProject::class)
					->as('projects')
					->withPivot('name', 'name_en', 'budget_amount', 'start_at', 'end_at')
					->withTimestamps();
	}
}
