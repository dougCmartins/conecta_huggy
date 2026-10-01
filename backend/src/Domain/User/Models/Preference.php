<?php

declare(strict_types=1);

namespace Domain\User\Models;

use Domain\Segment\Models\Segment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Preference extends Model
{
    protected $table = 'preferences';

    protected $fillable = ['user_id', 'is_subscribed'];

    protected function casts(): array
    {
        return [
            'is_subscribed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function segments(): BelongsToMany
    {
        return $this->belongsToMany(Segment::class, 'preference_segment');
    }
}
