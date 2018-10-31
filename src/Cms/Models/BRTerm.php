<?php

namespace Bradmin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BRTerm extends Model
{
    use Sluggable;

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
        'type', 'title', 'slug', 'description', 'parent_id', '_lft', '_rgt', 'depth'
    ];

    public function scopeTags($query)
    {
        return $query->where('type', 'tag');
    }

    public function scopeCategories($query)
    {
        return $query->where('type', 'category');
    }
}
