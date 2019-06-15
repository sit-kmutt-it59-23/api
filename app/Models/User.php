<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Traits\UsesUuidTrait;

/**
 * Class User
 * 
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $notifications
 * @property \Illuminate\Database\Eloquent\Collection $organizations
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \App\Models\UserDatum $user_datum
 *
 * @package App\Models
 */
class User extends Authenticable
{
	use Notifiable;
	use SoftDeletable { restore as private restoreA; }
	use EntrustUserTrait { restore as private restoreB; }
	use UsesUuidTrait;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'password'
	];

	public function notifications()
	{
		return $this->hasMany(\App\Models\Notification::class);
	}

	public function organizations()
	{
		return $this->belongsToMany(\App\Models\Organization::class)
					->using(\App\Models\OrganizationUser::class)
					->as('members')
					->withPivot('level_id', 'allowed_at')
					->withTimestamps();
	}

	public function user_datum()
	{
		return $this->hasOne(\App\Models\UserDatum::class);
	}

	public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }
}
