<?php

namespace App\Models\Service;

use App\Traits\HasImage;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Service extends Model
{
    use HasImage, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

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
        'working_days',
        'start_work',
        'end_work',
        'weekend_start_work',
        'weekend_end_work',
        'location',
        'phone',
    ];

    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            Category::class,
            'categoryable'
        );
    }
}
