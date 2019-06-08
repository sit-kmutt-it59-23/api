<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DocumentApprover
 * 
 * @property int $id
 * @property string $document_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Document $document
 * @property \App\Models\OrganizationUser $organization_user
 *
 * @package App\Models
 */
class DocumentApprover extends Eloquent
{
	protected $fillable = [
		'document_id',
		'user_id'
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
