<?php

namespace Bradmin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class BRPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'slug', 'description', 'content', 'status', 'url',
        'parent_id', '_lft', '_rgt', 'depth', 'user_id', 'template', 'thumb', 'comment_on', 'published_at'
    ];

//    public function terms()
//    {
//        return $this->morphToMany('Bradmin\Cms\Models\BRTerm', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id');
//    }

    public function tags()
    {
        return $this->morphToMany('Bradmin\Cms\Models\BRTag', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id');
    }

    public function categories()
    {
        return $this->morphToMany('Bradmin\Cms\Models\BRTerm', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id');
    }

    public function scopePages($query)
    {
        return $query->where('type', 'page');
    }

    public function scopePosts($query)
    {
        return $query->where('type', 'post');
    }
}
