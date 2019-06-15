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
 * @property string $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $first_name_th
 * @property string $middle_name_th
 * @property string $last_name_th
 * @property string $student_id
 * @property string $study_major_code
 * @property float $score_gpa
 * @property string $activity_experience
 * @property string $addr_street_1
 * @property string $addr_street_2
 * @property string $addr_sub_district
 * @property string $addr_district
 * @property string $addr_state
 * @property string $addr_postal_code
 * @property string $addr_country
 * @property string $tel_no
 * @property string $email
 * @property string $image_path_official
 * @property string $image_path_profil
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
	protected $keyType = 'string';

	protected $casts = [
		'score_gpa' => 'decimal:2'
	];

	protected $fillable = [
		'first_name_th',
		'middle_name_th',
		'last_name_th',
		'nationality',
		'study_major_code',
		'score_gpa',
		'activity_experience',
		'addr_street_1',
		'addr_street_2',
		'addr_sub_district',
		'addr_district',
		'addr_state',
		'addr_postal_code',
		'addr_country',
		'tel_no',
		'email',
		'image_path_official',
		'image_path_profile'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
