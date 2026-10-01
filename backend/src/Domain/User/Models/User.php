<?php

declare(strict_types=1);

namespace Domain\User\Models;

use Database\Factories\UserFactory;
use Domain\Content\Models\Article;
use Domain\Content\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function preference(): HasOne
    {
        return $this->hasOne(Preference::class);
    }

    protected static function booted(): void
    {
        static::updated(function (User $user): void {
            Cache::forget("user:{$user->id}");
        });

        static::deleted(function (User $user): void {
            Cache::forget("user:{$user->id}");
        });
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
