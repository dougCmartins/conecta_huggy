<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Segment extends Model
{
    use HasFactory;

    protected $table = 'segments';
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function articles(): BelongsToMany {
        return $this->belongsToMany(Article::class, 'articles_segment');
    }

    public function preferences(): BelongsToMany
    {
        return $this->belongsToMany(Preference::class, 'preference_segment');
    }
}
