<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    //  Register new user
    public function register(Request $request)
    {
        // Data validation
        $request->validate([
            'user_type' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            // Aditional data
            'store_name' => 'required_if:user_type,1|unique:stores',
            'address' => 'required_if:user_type,1',
            'username' => 'required_if:user_type,2|unique:user_clients',
        ]);

        // Register user
        $user = new User();
        $user->user_type = $request->user_type;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Throw Event
        $additionalData = $request->only([
            'store_name',
            'description',
            'phone_store',
            'address',
            'neighborhood',
            'rating',
            'username',
            'gender',
            'birthday'
        ]);
        event(new UserRegistered($user, $additionalData));

        // Response
        return response($user, Response::HTTP_CREATED);
    }

    //  Login user
    public function login(Request $request)
    {
        // Credential Validation
        $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // Check if login is email or phone
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [
            $login_type => $request->input('login'),
            'password' => $request->input('password')
        ];

        // Attemp to login
        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User */
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response(["token" => $token], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            $cookie = cookie()->forget('cookie_token');
            return response(["message" => "Invalid Credentials"], Response::HTTP_UNAUTHORIZED)->withCookie($cookie);
        };
    }

    //  Logout profile
    public function logout(Request $request)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        // Revoke tokens
        $user->tokens()->delete();

        // Remove cookie token
        $cookie = Cookie::forget('cookie_token');

        return response(["message" => "Logout Ok"], Response::HTTP_OK)->withCookie($cookie);
    }
}
