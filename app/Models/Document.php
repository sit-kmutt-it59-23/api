<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Document
 * 
 * @property int $id
 * @property int $organization_id
 * @property int $type_id
 * @property int $version_id
 * @property int $category_id
 * @property string $name
 * @property string $name_en
 * @property string $data
 * @property bool $is_draft
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\DocumentCategory $document_category
 * @property \App\Models\Organization $organization
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
	protected $casts = [
		'organization_id' => 'int',
		'type_id' => 'int',
		'version_id' => 'int',
		'category_id' => 'int',
		'is_draft' => 'bool'
	];

	protected $fillable = [
		'organization_id',
		'type_id',
		'version_id',
		'category_id',
		'name',
		'name_en',
		'data',
		'is_draft'
	];

	public function document_category()
	{
		return $this->belongsTo(\App\Models\DocumentCategory::class, 'category_id');
	}

	public function organization()
	{
		return $this->belongsTo(\App\Models\Organization::class);
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
