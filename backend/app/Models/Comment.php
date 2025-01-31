<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'article_id', 'comment'];

    public function user():HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function article():BelongsTo {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
