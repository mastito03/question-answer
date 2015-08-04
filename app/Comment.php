<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Revisionable\Laravel\RevisionableTrait;

use Markdown;

class Comment extends Model
{

	use SoftDeletes;

	protected $fillable = ['content'];

	protected $dates = ['deleted_at'];

	public function getParsedContentAttribute()
	{
		return Markdown::parse($this->content, ['config' => 'comments'] );
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function comment_to()
	{
		return $this->morphTo('comment_to');
	}

}
