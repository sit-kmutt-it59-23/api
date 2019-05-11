<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentVersion
 * 
 * @property int $id
 * @property int $type_id
 * @property string name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\DocumentType $document_type
 * @property \Illuminate\Database\Eloquent\Collection $document_form_elements
 * @property \Illuminate\Database\Eloquent\Collection $documents
 *
 * @package App\Models
 */
class DocumentVersion extends Eloquent
{
	protected $casts = [
		'type_id' => 'int'
	];

	protected $fillable = [
		'type_id',
		'name',
	];

	public function document_type()
	{
		return $this->belongsTo(\App\Models\DocumentType::class, 'type_id');
	}

	public function document_form_elements()
	{
		return $this->hasMany(\App\Models\DocumentFormElement::class, 'version_id');
	}

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class, 'version_id');
	}
}
