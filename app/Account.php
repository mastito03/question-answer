<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{

	use SoftDeletes;

	protected $fillable = ['moderator'];

	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function site()
	{
		return $this->belongsTo('App\Site');
	}

}
