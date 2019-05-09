<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentType
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $document_type_steps
 * @property \Illuminate\Database\Eloquent\Collection $document_versions
 * @property \Illuminate\Database\Eloquent\Collection $documents
 *
 * @package App\Models
 */
class DocumentType extends Eloquent
{
	protected $fillable = [
		'name',
		'description'
	];

	public function document_type_steps()
	{
		return $this->hasMany(\App\Models\DocumentTypeStep::class, 'type_id');
	}

	public function document_versions()
	{
		return $this->hasMany(\App\Models\DocumentVersion::class, 'type_id');
	}

	public function documents()
	{
		return $this->hasMany(\App\Models\Document::class, 'type_id');
	}
}
