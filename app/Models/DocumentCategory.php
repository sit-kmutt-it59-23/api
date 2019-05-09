<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentCategory
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $documents
 *
 * @package App\Models
 */
class DocumentCategory extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description'
	];

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class, 'category_id');
	}
}
