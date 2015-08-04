<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Revisionable\Laravel\RevisionableTrait;
use Sofa\Revisionable\Revisionable;

class Site extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'url', 'description', 'beta'];

	protected $dates = ['deleted_at'];

	public function scopeSiteavaliable($query, $url)
	{
		$query->where('url',$url);
	}

	public function accounts()
	{
		return $this->hasMany('App\Account');
	}

	public function questions()
	{
		return $this->hasMany('App\Question');
	}

	public function answers()
	{
		return $this->hasManyThrough('App\Answer','App\Question');
	}

    public function users()
    {
        return $this->belongsToMany('App\User','accounts');
    }
}
