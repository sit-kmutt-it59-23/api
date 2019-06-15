<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 11 May 2019 14:51:46 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use App\Traits\UsesUuidTrait;

/**
 * Class Document
 * 
 * @property string $id
 * @property string $project_id
 * @property int $type_id
 * @property int $version_id
 * @property string $name
 * @property string $name_en
 * @property string $data
 * @property bool $is_draft
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\DocumentProject $document_project
 * @property \App\Models\DocumentType $document_type
 * @property \App\Models\DocumentVersion $document_version
 * @property \Illuminate\Database\Eloquent\Collection $document_approvals
 * @property \Illuminate\Database\Eloquent\Collection $document_comments
 * @property \Illuminate\Database\Eloquent\Collection $document_members
 * @property \Illuminate\Database\Eloquent\Collection $document_step_users
 *
 * @package App\Models
 */
class Document extends Eloquent
{
	use UsesUuidTrait;
	
	public $incrementing = false;
	protected $keyType = 'string';
	
	protected $casts = [
		'project_id' => 'int',
		'type_id' => 'int',
		'version_id' => 'int',
		'is_draft' => 'bool'
	];

	protected $fillable = [
		'project_id',
		'type_id',
		'version_id',
		'name',
		'name_en',
		'data',
		'is_draft'
	];

	public function document_project()
	{
		return $this->belongsTo(\App\Models\DocumentProject::class, 'project_id');
	}

	public function document_type()
	{
		return $this->belongsTo(\App\Models\DocumentType::class, 'type_id');
	}

	public function document_version()
	{
		return $this->belongsTo(\App\Models\DocumentVersion::class, 'version_id');
	}

	public function document_approvals()
	{
		return $this->hasMany(\App\Models\DocumentApproval::class);
	}

	public function document_comments()
	{
		return $this->hasMany(\App\Models\DocumentComment::class);
	}

	public function document_members()
	{
		return $this->hasMany(\App\Models\DocumentMember::class);
	}

	public function document_step_users()
	{
		return $this->hasMany(\App\Models\DocumentStepUser::class);
	}
}
