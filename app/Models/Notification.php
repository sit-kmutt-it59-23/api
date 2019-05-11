<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Notification
 * 
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property string $link
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $expired_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Notification extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $dates = [
		'read_at',
		'expired_at'
	];

	protected $fillable = [
		'user_id',
		'content',
		'link',
		'expired_at'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
