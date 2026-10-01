<?php

declare(strict_types=1);

namespace Domain\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    protected $fillable = ['user_id'];

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
