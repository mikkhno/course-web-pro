<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registration()
    {
        return view('registration');
    }

    public function login(Request $request)
    {
        //перевірка вхідних даних для авторизації
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Обробка помилок валідації
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], 422);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $id = Auth::id();
            // успішна авторизація
            return redirect()->route('main', ['id' => $id]);
        } else {
            // виникла проблема
            return redirect()->back()->withErrors(['message' => 'Невірні облікові дані']);
        }

    }


    public function create(Request $request)
    {
        //перевірка уведених даних
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|max:255',
        ], [
            'first_name.required' => 'The name field is required.',
            'last_name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'phone.required' => 'The phone field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //збереження нової інформації про користувача

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->telegram = $request->telegram;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $id = Auth::id();
            // Користувач успішно зареєстрований і авторизований
            return redirect()->route('main', ['id' => $id]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

