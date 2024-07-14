<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $token = $user->createToken("JWT")->plainTextToken;

            $data = [
                "token" => $token,
                "user" => $user,
            ];

            return Response::success("usuário logado com sucesso", 200, ["data" => $data]);
        }

        return Response::error("Email ou senha inválida", 401);
    }
    public function logout()
    {
        return "logout";
    }
}
