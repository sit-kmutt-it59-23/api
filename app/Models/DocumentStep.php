<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentStep
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $document_types
 *
 * @package App\Models
 */
class DocumentStep extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function document_types()
	{
		return $this->belongsToMany(\App\Models\DocumentType::class, 'document_type_step', 'step_id', 'type_id')
					->using(\App\Models\DocumentTypeStep::class)
					->withPivot('order');
	}
}
