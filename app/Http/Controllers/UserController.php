<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $phone = str_replace('+', '', $request->phone);
        $phone  = trim($phone);
        $user = User::where('phone', $phone)->first();
        if ($user) {
            return response()->json(['messages' => 'Пользователь уже имеется'], 500);
        }
        $created = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $phone,
            'password' => bcrypt($request->password),
        ]);
        if (!$created) {
            return response()->json(['messages' => 'Попробуйте позже'], 500);
        }
        $newUser = User::where('phone', $phone)->first();
        $token = $newUser->createToken('api-token')->plainTextToken;
        return response()->json(['success' => true, 'token' => $token,'data' => $newUser]);
    }

    public function login(LoginRequest $request)
    {
        $phone = str_replace('+', '', $request->phone);
        $phone  = trim($phone);
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            return response()->json(['messages' => 'Неправильный логин или пароль'], 500);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['messages' => 'Неправильный логин или пароль'], 500);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['success' => true, 'token' => $token,'data' => $user]);
    }
}
