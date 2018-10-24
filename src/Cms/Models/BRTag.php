<?php

namespace Bradmin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class BRTag extends BRTerm
{
    protected $table = 'b_r_terms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'slug', 'description', 'parent_id', '_lft', '_rgt', 'depth'
    ];
}
