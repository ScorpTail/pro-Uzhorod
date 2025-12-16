<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Categoryable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categoryables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'categoryable_id',
        'categoryable_type',
    ];
}
