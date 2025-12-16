<?php

namespace App\Models\News;

use App\Models\User;
use App\Traits\HasImage;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class News extends Model
{
    use HasImage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'short_description',
        'status',
        'user_id',
        'views',
    ];

    /**
     * Get the author that owns the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            Category::class,
            'categoryable'
        );
    }
}
