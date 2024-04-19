<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $username = $credentials['username'];
        $password = $credentials['password'];
        $remember = $credentials['remember'] ?? false;

        if (! Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            return response([
                'message' => 'Usuario o contraseña incorrectos'
            ], 401);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response(compact('user', 'token'), 200);
        // it's the same -> return response()->json(['user' => $user,'token' => $token]);

    }

    public function signup(SignupRequest $request)
    {
        $data = $request->validated();
        if (User::where('username', $data['username'])->exists()) {
            return response()->json(['message' => 'El nombre de usuario ya existe'], 422);
        }
        if (User::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'El email ya está en uso'], 422);
        }
        /** @var User $user */
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('main')->plainTextToken;

        //return response(compact('user', 'token'));
        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function logout(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $user->tokens()->where('id', auth()->id())->delete();
        return response('', 204);

    }
}
