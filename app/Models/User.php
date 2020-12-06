<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $no_hp
 * @property string|null $address
 * @property bool $is_verified
 * @property int $role_id
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property Collection|Auction[] $auctions
 * @property Collection|Bid[] $bids
 * @property Collection|Crowdfund[] $crowdfunds
 * @property Collection|Donation[] $donations
 * @property Collection|Report[] $reports
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use Notifiable;
	protected $table = 'users';

	protected $casts = [
		'is_verified' => 'bool',
		'role_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'no_hp',
		'address',
		'is_verified',
		'role_id',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function auctions()
	{
		return $this->hasMany(Auction::class);
	}

	public function bids()
	{
		return $this->hasMany(Bid::class);
	}

	public function crowdfunds()
	{
		return $this->hasMany(Crowdfund::class);
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
