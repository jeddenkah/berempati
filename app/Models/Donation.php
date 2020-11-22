<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Donation
 * 
 * @property int $id
 * @property int $user_id
 * @property int $crowdfund_id
 * @property int $nominal
 * @property string $message
 * @property bool $is_anonym
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Crowdfund $crowdfund
 * @property User $user
 *
 * @package App\Models
 */
class Donation extends Model
{
	protected $table = 'donations';

	protected $casts = [
		'user_id' => 'int',
		'crowdfund_id' => 'int',
		'nominal' => 'int',
		'is_anonym' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'crowdfund_id',
		'nominal',
		'message',
		'is_anonym'
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
