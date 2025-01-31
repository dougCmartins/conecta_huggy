<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }
    public function getUser(Request $request)
    {
        $userId = Auth::id();
        $key = "user:{$userId}";

        $userData = Cache::remember(
            $key,
            now()->addMinutes(10),
            function () use ($request) {
                return $request->user()->load('preference.segments');
            });
        return response()->json($userData);
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->repository->create($request->validated());

        return response()->json($user, 200);
    }

    public function syncUserPreferences(PreferenceRequest $request)
    {
        $user = $this->repository->syncUserPreferences($request->validated());

        return response()->json($user, 200);
    }
    public function update(UserRequest $request, User $user) {
        $data = $request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }
}
