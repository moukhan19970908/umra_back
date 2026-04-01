<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::where('email',$request->email)->first();
        if ($user){
            return response()->json(['messages' => 'Пользователь уже имеется']);
        }
        $created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        if (!$created){
            return response()->json(['messages' => 'Попробуйте позже']);
        }
        return response()->json(['success' => true]);
    }

    public function login(LoginRequest $request){
        $user = User::where('email',$request->email)->first();
        if (!$user){
            return response()->json(['messages' => 'Неправильный логин или пароль']);
        }
        if (!Hash::check($request->password,$user->password)){
            return response()->json(['messages' => 'Неправильный логин или пароль']);
        }
        return response()->json(['success' => true]);
    }
}
