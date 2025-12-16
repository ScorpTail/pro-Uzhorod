<?php

namespace App\Models\Attraction;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasImage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attractions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'status',
        'location',
        'entry_fee',
        'working_days',
        'start_time',
        'end_time',
        'weekend_start_time',
        'weekend_end_time',
        'rating'
    ];
}
