<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\System\ValidationErrorResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\API\UserRegisteredSuccessfullyResource;
use App\Http\Resources\API\UserLoggedOutSuccessfullyResource;
use App\Http\Resources\API\UserLoggedInSuccessfullyResource;
use App\Http\Resources\API\System\ServerErrorResource;
use Exception;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            $token = $user->createToken('myapptoken')->plainTextToken;

        } catch (Exception $e) {
            return new ServerErrorResource(null);
        }

        return new UserRegisteredSuccessfullyResource($user, $token);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::where('email', $validated['email'])->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return new ValidationErrorResource(['email' => ['The provided credentials are incorrect.']]);
            }

        } catch (Exception $e) {
            return new ServerErrorResource(null);
        }

        return new UserLoggedInSuccessfullyResource($user, $user->createToken('myapptoken')->plainTextToken);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return new UserLoggedOutSuccessfullyResource(null);
    }


}
