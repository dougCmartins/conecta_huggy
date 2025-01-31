<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Preference extends Model
{
    protected $table = 'preferences';

    public $timestamps = false;

    protected $fillable = ['user_id', 'is_subscribed'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function segments(): BelongsToMany {
        return $this->belongsToMany(Segment::class, 'preference_segment');
    }
}
