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
 * @property \Illuminate\Database\Eloquent\Collection $document_type_steps
 *
 * @package App\Models
 */
class DocumentStep extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function document_type_steps()
	{
		return $this->hasMany(\App\Models\DocumentTypeStep::class, 'step_id');
	}
}
