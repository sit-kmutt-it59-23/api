<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentTypeStep
 * 
 * @property int $id
 * @property int $type_id
 * @property int $step_id
 * @property int $order
 * 
 * @property \App\Models\DocumentStep $document_step
 * @property \App\Models\DocumentType $document_type
 *
 * @package App\Models
 */
class DocumentTypeStep extends Eloquent
{
	protected $table = 'document_type_step';
	public $timestamps = false;

	protected $casts = [
		'type_id' => 'int',
		'step_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'type_id',
		'step_id',
		'order'
	];

	public function document_step()
	{
		return $this->belongsTo(\App\Models\DocumentStep::class, 'step_id');
	}

	public function document_type()
	{
		return $this->belongsTo(\App\Models\DocumentType::class, 'type_id');
	}
}
