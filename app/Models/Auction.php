<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Auction
 * 
 * @property int $id
 * @property int $user_id
 * @property int $crowdfund_id
 * @property string $image
 * @property string $desc
 * @property int $start_nominal
 * @property Carbon $target_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Crowdfund $crowdfund
 * @property User $user
 * @property Collection|Bid[] $bids
 *
 * @package App\Models
 */
class Auction extends Model
{
	protected $table = 'auctions';

	protected $casts = [
		'user_id' => 'int',
		'crowdfund_id' => 'int',
		'start_nominal' => 'int'
	];

	protected $dates = [
		'target_date'
	];

	protected $fillable = [
		'user_id',
		'crowdfund_id',
		'name',
		'image',
		'desc',
		'start_nominal',
		'target_date'
	];

	public function crowdfund()
	{
		return $this->belongsTo(Crowdfund::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function bids()
	{
		return $this->hasMany(Bid::class);
	}
}
