<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot as Eloquent;

/**
 * Class OrganizationUser
 * 
 * @property int $id
 * @property string $user_id
 * @property string $organization_id
 * @property int $level_id
 * @property boolean $is_allowed
 * @property \Carbon\Carbon $allowed_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\OrganizationUserLevel $organization_user_level
 * @property \Illuminate\Database\Eloquent\Collection $document_approvals
 * @property \Illuminate\Database\Eloquent\Collection $document_comments
 * @property \Illuminate\Database\Eloquent\Collection $document_members
 * @property \Illuminate\Database\Eloquent\Collection $document_step_users
 *
 * @package App\Models
 */
class OrganizationUser extends Eloquent
{
	protected $table = 'organization_user';
	public $incrementing = true;

	protected $casts = [
		'user_id' => 'int',
		'organization_id' => 'int',
		'level_id' => 'int',
		'is_allowed' => 'boolean'
	];

	protected $dates = [
		'allowed_at',
	];

	protected $fillable = [
		'level_id',
	];

	public function organization_user_level()
	{
		return $this->belongsTo(\App\Models\OrganizationUserLevel::class, 'level_id');
	}

	public function document_approvals()
	{
		return $this->hasMany(\App\Models\DocumentApproval::class, 'user_id');
	}

	public function document_comments()
	{
		return $this->hasMany(\App\Models\DocumentComment::class, 'user_id');
	}

	public function document_members()
	{
		return $this->hasMany(\App\Models\DocumentMember::class, 'user_id');
	}

	public function document_step_users()
	{
		return $this->hasMany(\App\Models\DocumentStepUser::class, 'user_id');
	}
}
