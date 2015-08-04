<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Revisionable\Laravel\RevisionableTrait;
use Sofa\Revisionable\Revisionable;

use Markdown;

class Tag extends Model implements Revisionable
{
	use SoftDeletes;

    use RevisionableTrait;

    protected $fillable = ['name','content','excerpt','revision_message'];

	protected $revisionable = ['name','content','excerpt','revision_message'];

	protected $dates = ['deleted_at'];

	public function getExcerptOrContentAttribute()
	{
		if($this->excerpt !== '')
			return $this->excerpt;
		return str_limit($this->striped_content);
	}

	public function getParsedContentAttribute()
	{
		return clean(Markdown::parse($this->content));
	}

	public function getStripedContentAttribute()
	{
		return strip_tags($this->parsed_content);
	}

	public function scopeSearch($query, $name)
	{
		$query->where('name','like',"%$name%");
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function site()
	{
		return $this->belongsTo('App\Site');
	}

	public function questions()
	{
		return $this->belongsToMany('App\Question')->withTimestamps();
	}

}
