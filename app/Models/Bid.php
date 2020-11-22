<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bid
 * 
 * @property int $id
 * @property int $user_id
 * @property int $auction_id
 * @property int $nominal
 * @property string $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Auction $auction
 * @property User $user
 *
 * @package App\Models
 */
class Bid extends Model
{
	protected $table = 'bids';

	protected $casts = [
		'user_id' => 'int',
		'auction_id' => 'int',
		'nominal' => 'int'
	];

	protected $fillable = [
		'user_id',
		'auction_id',
		'nominal',
		'desc'
	];

	public function auction()
	{
		return $this->belongsTo(Auction::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
