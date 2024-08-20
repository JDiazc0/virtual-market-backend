<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
