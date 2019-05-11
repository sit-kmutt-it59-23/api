<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class UserDatum
 * 
 * @property int $user_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $student_id
 * @property string $tel_no
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserDatum extends Eloquent
{
	protected $primaryKey = 'user_id';
	public $incrementing = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'firstname',
		'middlename',
		'lastname',
		'student_id',
		'tel_no'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
