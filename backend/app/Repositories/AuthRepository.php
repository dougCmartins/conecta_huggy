<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
     public function authenticate(array $credentials): string
     {
         $user = Auth::user();
         $user->tokens()->delete();

         $token =  $user->createToken('ConectaHuggy', ['expiration' => 525600])->plainTextToken;

         return $token;
     }
}
