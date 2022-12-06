<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{

    /* Register Api */
    function register(Request $request) {
        $request->validateWithBag('errors',[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ],
    [
        'name.required' => 'Nome richiesto',
        'email.required' => 'Email richiesta',
        'email.unique' => 'Email già in uso',
        'password.required' => 'Password richiesta',
        'confirm_password.required' => 'Il campo conferma password è richiesto',
        'confirm_password.same' => 'La password di conferma non è la stessa del campo password'
    ]);


        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /* Login Api */
    function login(Request $request) {
            $request->validateWithBag('errors',[
                'email' => 'required|email',
                'password' => 'required'
            ],
        [
            'email.required' => 'Email richiesta',
            'password.required' => 'Password richiesta'
        ]);

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'errors' => [
                        'message' => array('Email o Password non corretti.')
                    ],
                    'status' => false,

                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Utente collegato con successo',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);

    }

    /* Logout Api
    * @return \Laravel\Fortify\Contracts\LogoutResponse
    */
    function logout(Request $request){
        /* Revoke all tokens of the current user
        If Intelephense gives error, it's a bug of the extension
        */
        Auth::user()->tokens()->delete();

        return response()->json([],200);
    }
}
