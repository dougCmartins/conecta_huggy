<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'topic_id',
        'user_id',
        'comment'
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
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
