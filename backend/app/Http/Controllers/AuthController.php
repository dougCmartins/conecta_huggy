<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function __construct(protected AuthRepositoryInterface $repository)
    {
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token  = $this->repository->authenticate($credentials);

        return response()->json(['token' => $token], 200);
    }
    public function sendToZapier(array $credentials)
    {
        $url = 'https://hooks.zapier.com/hooks/catch/15892772/3r3hwiq/';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, [
            "nome" => $credentials['nome'],
            "email" => $credentials['email'],
            "id_da_campanha" => "701U600000JM6biIAD",
            "lead_source" => "Teste"
        ]);

        return response()->json($response->json(), $response->status());
    }
}
