<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property int $user_id
 * @property int $crowdfund_id
 * @property string $image
 * @property string $desc
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Crowdfund $crowdfund
 * @property User $user
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'user_id' => 'int',
		'crowdfund_id' => 'int'
	];


	protected $fillable = [
		'user_id',
		'crowdfund_id',
		'image',
		'desc',
		'datetime'
	];

	public function crowdfund()
	{
		return $this->belongsTo(Crowdfund::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
