<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentComment
 * 
 * @property int $id
 * @property int $document_id
 * @property int $user_id
 * @property string $data
 * @property int $children_of
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\DocumentComment $document_comment
 * @property \App\Models\Document $document
 * @property \App\Models\OrganizationUser $organization_user
 * @property \Illuminate\Database\Eloquent\Collection $document_comments
 *
 * @package App\Models
 */
class DocumentComment extends Eloquent
{
	public $incrementing = false;
	protected $keyType = 'string';
	
	protected $fillable = [
		'document_id',
		'user_id',
		'data',
		'children_of'
	];

	public function document_comment()
	{
		return $this->belongsTo(\App\Models\DocumentComment::class, 'children_of');
	}

	public function document()
	{
		return $this->belongsTo(\App\Models\Document::class);
	}

	public function organization_user()
	{
		return $this->belongsTo(\App\Models\OrganizationUser::class, 'user_id');
	}

	public function document_comments()
	{
		return $this->hasMany(\App\Models\DocumentComment::class, 'children_of');
	}
}
