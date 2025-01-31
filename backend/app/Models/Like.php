<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = ['user_id'];

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
