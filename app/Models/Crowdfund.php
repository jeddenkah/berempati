<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Crowdfund
 * 
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $desc
 * @property string $image
 * @property int|null $target_nominal
 * @property Carbon|null $target_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Auction[] $auctions
 * @property Collection|Donation[] $donations
 * @property Collection|Report[] $reports
 *
 * @package App\Models
 */
class Crowdfund extends Model
{
	protected $table = 'crowdfunds';

	protected $casts = [
		'user_id' => 'int',
		'target_nominal' => 'int'
	];

	protected $dates = [
		'target_date'
	];

	protected $fillable = [
		'user_id',
		'name',
		'desc',
		'image',
		'target_nominal',
		'target_date'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function auctions()
	{
		return $this->hasMany(Auction::class);
	}

	public function donations()
	{
		return $this->hasMany(Donation::class);
	}

	public function reports()
	{
		return $this->hasMany(Report::class);
	}
}
