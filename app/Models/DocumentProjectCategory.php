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
* @property \Illuminate\Database\Eloquent\Collection $document_projects
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

	public function document_projects()
	{
		return $this->hasMany(\App\Models\DocumentProject::class, 'category_id');
	}
}
