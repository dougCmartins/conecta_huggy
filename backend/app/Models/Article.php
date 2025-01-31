<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'content',
        'image',
        'published',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function segments(): BelongsToMany {
        return $this->belongsToMany(Segment::class, 'articles_segment');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'articles_category');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
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
