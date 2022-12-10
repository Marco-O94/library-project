<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of users
     *
     * @return \Illuminate\Http\Response
     */

    /* Update own user profile */

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        // Request user through token
        $user = $request->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user = User::where('id', $user->id)->with('role')->first();
        return response()->json([
            'message' => 'Profilo modificato con successo',
            'user' => $user,
        ], 201);
    }


    /* Update image */
    public function updateImage(Request $request)
    {
        $request->validate(
            [
                'userpic' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ],
            [
                'userpic.required' => 'Seleziona un\'immagine',
                'userpic.image' => 'Il file selezionato non è un\'immagine',
                'userpic.mimes' => 'Il file selezionato non è un\'immagine',
                'userpic.max' => 'L\'immagine deve essere di massimo 1MB',
            ]
        );

        $user = $request->user();
        // Store Avatar
        $filename = $request->userpic->getClientOriginalName(); //Get original file name
        $path = $request->userpic->storeAs('images/avatars', $filename, 'public');
        $user->update([
            'image_path' => $path
        ]);
        $user = User::where('id', $request->user()->id)->with('role')->first();

        return response()->json([
            'user' =>  $user,
            'message' => 'Immagine aggiornata con successo'
        ], 201);
    }
}
