<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentFormElement
 * 
 * @property int $id
 * @property int $version_id
 * @property string $title
 * @property string $type
 * @property string $default_value
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\DocumentVersion $document_version
 *
 * @package App\Models
 */
class DocumentFormElement extends Eloquent
{
	protected $table = 'document_form_element';

	protected $casts = [
		'version_id' => 'int'
	];

	protected $fillable = [
		'version_id',
		'title',
		'type',
		'default_value',
		'data'
	];

	public function document_version()
	{
		return $this->belongsTo(\App\Models\DocumentVersion::class, 'version_id');
	}
}
