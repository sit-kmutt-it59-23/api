<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentApproval
 * 
 * @property int $id
 * @property int $document_id
 * @property int $user_id
 * @property bool $is_passed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Document $document
 * @property \App\Models\OrganizationUser $organization_user
 *
 * @package App\Models
 */
class DocumentApproval extends Eloquent
{
	protected $casts = [
		'document_id' => 'int',
		'user_id' => 'int',
		'is_passed' => 'boolean'
	];

	protected $fillable = [
		'document_id',
		'user_id',
		'is_passed'
	];

	public function document()
	{
		return $this->belongsTo(\App\Models\Document::class);
	}

	public function organization_user()
	{
		return $this->belongsTo(\App\Models\OrganizationUser::class, 'user_id');
	}
}
