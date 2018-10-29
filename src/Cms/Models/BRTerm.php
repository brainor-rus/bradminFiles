<?php

namespace Bradmin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class BRTerm extends Model
{
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
