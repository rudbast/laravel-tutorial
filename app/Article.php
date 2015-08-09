<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    /**
     * Related table name in database
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Enables which field is allowed to be added in form for an article
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'published_at'];

    /**
     * Additional fields to treat as a Carbon instance (date features)
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Scope queries to articles that have been published
     * format : scope{Name}
     * usage  : {Model}::first()->{name}()->get();
     *
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Set the published_at attribute, automatically by laravel (scope)
     * format : set{AttributeName}Attribute({$data})
     * call : $article->published();
     *
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    /**
     * Set default published_at to today when requested, automatically
     *
     * @param  $date
     * @return Carbon formatted date
     */
    public function getPublishedAtAttribute($date)
    {
        // return new Carbon($date);
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * An article is owned by a user
     *
     * @return Relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    } // $article->user // user_id

    /**
     * Get the tags associated with the given article
     *
     * @return Relationship
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Get a list of tag ids associated with the current article
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->toArray();
    }
}
