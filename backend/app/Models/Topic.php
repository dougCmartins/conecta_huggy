<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'subtitle',
        'content',
        'image',
        'is_closed',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }

    public function likes():MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function views():MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
