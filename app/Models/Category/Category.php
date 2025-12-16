<?php

namespace App\Models\Category;

use App\Enums\StatusEnum;
use App\Models\News\News;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasImage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'status',
        'parent_id',
    ];

    /**
     * Get all of the subCategories for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->where('status', StatusEnum::ACTIVE->value);
    }

    /**
     * Get the parent that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Get all of the children for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function news(): MorphToMany
    {
        return $this->morphedByMany(
            News::class,
            'categoryable'
        );
    }

    /**
     * Get all of the siblings for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siblings(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'parent_id')
            ->where('id', '!=', $this->id)
            ->where('status', StatusEnum::ACTIVE->value);
    }
}
