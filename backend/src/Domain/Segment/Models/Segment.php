<?php

declare(strict_types=1);

namespace Domain\Segment\Models;

use Database\Factories\SegmentFactory;
use Domain\Content\Models\Article;
use Domain\User\Models\Preference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Segment extends Model
{
    use HasFactory;

    protected $table = 'segments';

    protected $fillable = ['name', 'description'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'articles_segment');
    }

    public function preferences(): BelongsToMany
    {
        return $this->belongsToMany(Preference::class, 'preference_segment');
    }

    protected static function newFactory(): SegmentFactory
    {
        return SegmentFactory::new();
    }
}
