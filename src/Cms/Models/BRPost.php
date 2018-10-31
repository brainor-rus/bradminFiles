<?php

namespace Bradmin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class BRPost extends Model
{
    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'slug', 'description', 'content', 'status', 'url',
        'parent_id', '_lft', '_rgt', 'depth', 'user_id', 'template', 'thumb', 'comment_on', 'published_at', 'created_at', 'updated_at'
    ];

    public function getDefaultUrlAttribute()
    {
        $ancestors[] = $this->slug;
        foreach ($this->ancestors as $ancestor)
        {
            $ancestors[] = $ancestor->slug;
        }

        $ancestors = array_reverse($ancestors);

        $url = '';
        foreach ($ancestors as $ancestor)
        {
            $url .= ('/' . $ancestor);
        }

        return $url;
    }

    public function terms()
    {
        return $this->morphToMany('Bradmin\Cms\Models\BRTerm', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id');
    }

    public function tags()
    {
        return $this->morphToMany('Bradmin\Cms\Models\BRTag', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id')->where('type', 'tag');
    }

    public function categories()
    {
        return $this->morphToMany('Bradmin\Cms\Models\BRTerm', 'b_r_termable', 'b_r_termables', 'b_r_termable_id', 'b_r_term_id')->where('type', 'category');
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
