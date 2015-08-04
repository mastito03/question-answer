<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Revisionable\Laravel\RevisionableTrait;
use Sofa\Revisionable\Revisionable;

use Markdown;

class Answer extends Model implements Revisionable
{

	use SoftDeletes;

    use RevisionableTrait;

	protected $fillable = ['content','revision_message'];

	protected $revisionable = ['content','revision_message'];

	protected $dates = ['deleted_at'];

	public function getParsedContentAttribute()
	{
		return Markdown::parse($this->content);
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function question()
	{
		return $this->belongsTo('App\Question');
	}

	public function comments()
	{
		return $this->morphMany('App\Comment', 'comment_to');
	}

}
