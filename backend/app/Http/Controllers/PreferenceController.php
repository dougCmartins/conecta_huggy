<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreferenceRequest;
use App\Repositories\PreferenceRepository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function __construct(protected PreferenceRepository $repository)
    {

    }

    public function store(PreferenceRequest $request)
    {
        $userId = Auth::id();
        $preference = $this->repository->create($userId, $request->validated());

        return response()->json([$preference, 201]);
    }

    public function update(PreferenceRequest $request, int $id)
    {
        $preference = $this->repository->update($id, $request->validated());

        return response()->json([$preference, 201]);
    }
}
