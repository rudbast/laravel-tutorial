<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Related table name in database
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Enables which field is allowed to be added in form for an article
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the articles associated with the given tag
     *
     * @return Relationship
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }
}
