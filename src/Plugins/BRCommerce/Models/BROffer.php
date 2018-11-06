<?php

namespace Bradmin\Plugins\BRCommerce\Models;

use Bradmin\Cms\Models\BRTerm;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class BROffer extends Model
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
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name', 'slug', 'discount', 'price', 'category_id', 'visible', 'description', 'article', 'producer_id'
    ];

    public function category()
    {
        return $this->hasOne(BRTerm::class, 'id', 'category_id');
    }
}
