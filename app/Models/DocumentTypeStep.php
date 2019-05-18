<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 14 Apr 2019 20:05:04 +0700.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot as Eloquent;

/**
 * Class DocumentTypeStep
 * 
 * @property int $id
 * @property int $type_id
 * @property int $step_id
 * @property int $order
 *
 * @package App\Models
 */
class DocumentTypeStep extends Eloquent
{
	protected $table = 'document_type_step';
	public $timestamps = false;

	protected $casts = [
		'type_id' => 'int',
		'step_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'order'
	];
}
