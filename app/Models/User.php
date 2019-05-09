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

/**
 * Class User
 * 
 * @property int $id
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
    use EntrustUserTrait, Notifiable, SoftDeletable;

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
					->withPivot('id', 'level_id')
					->withTimestamps();
	}

	public function user_datum()
	{
		return $this->hasOne(\App\Models\UserDatum::class);
	}
}
