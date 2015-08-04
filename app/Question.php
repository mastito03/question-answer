<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Revisionable\Laravel\RevisionableTrait;
use Sofa\Revisionable\Revisionable;

use Markdown;

class Question extends Model implements Revisionable
{

	use SoftDeletes;

	use RevisionableTrait;

	protected $fillable = ['title','content','revision_message'];

	protected $revisionable = ['title','content','revision_message'];

	protected $dates = ['deleted_at'];

	public function getParsedContentAttribute()
	{
		return Markdown::parse($this->content);
	}

	public function getStripedContentAttribute()
	{
		return strip_tags($this->parsed_content);
	}

	public function getAnswersCountAttribute()
	{
		if(!array_key_exists('answersCount',$this->relations))
			$this->load('answersCount');
		$related = $this->getRelation('answersCount');
		return $related ? (int) $related->count : 0 ;
	}

	public function getTagsListAttribute()
	{
		return $this->tags->lists('id');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function site()
	{
		return $this->belongTo('App\Site');
	}

	public function answers()
	{
		return $this->hasMany('App\Answer');
	}

	public function comments()
	{
		return $this->morphMany('App\Comment', 'comment_to');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	public function votes()
	{
		return $this->morphToMany('App\User','votes')->withTimestamps();
	}

	public function favorites()
	{
		return $this->belongsToMany('App\User','favorites')->withTimestamps();
	}

	public function answersCount()
	{
		return $this->hasOne('App\Answer')->selectRaw('question_id, count(*) as count')->groupBy('question_id');
	}

	public function isFavorited($user)
	{
		if(empty($user)) return false;
		return $this->favorites()->where('user_id', $user->id)->count() > 0;
	}

	public function isUpVoted($user)
	{
		if(empty($user)) return false;
		return $this->votes()->where('user_id', $user->id)->where('votes', 1)->count() > 0;
	}

	public function isDownVoted($user)
	{
		if(empty($user)) return false;
		return $this->votes()->where('user_id', $user->id)->where('votes', -1)->count() > 0;
	}

}
