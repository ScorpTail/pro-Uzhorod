<?php

namespace App\Models\Appeal;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appeal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appeals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'administrator_id',
    ];

    /**
     * Get the user that owns the Appeal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the administrator that owns the Appeal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'administrator_id', 'id');
    }
}
