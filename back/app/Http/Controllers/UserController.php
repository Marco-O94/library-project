<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->each(function ($user) {
            $user->role = $user->role()->get();
            $user->books = $user->books()->get();
        });

        return response()->json([$users], 200);
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('role', 'books')->get();

        return response()->json([$user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user->role = $user->role()->get();
        $user->books = $user->books()->get();

        return response()->json([$user], 200);
    }


    /* Update own user profile */

    public function selfUpdate(Request $request)
    {
        $request->validateWithBag('user', [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'. $request->user()->id,
        ]);

        // Request user through token
        $user = $request->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'message' => 'Profilo modificato con successo',
            'user' => $user,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'Utente eliminato con successo'
        ], 201);
    }

    /* Update image */
    public function updateImage(Request $request)
    {
        $request->validateWithBag('imagebag', [
            'userpic' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'userpic.required' => 'Seleziona un\'immagine',
            'userpic.image' => 'Il file selezionato non è un\'immagine',
            'userpic.mimes' => 'Il file selezionato non è un\'immagine',
            'userpic.max' => 'L\'immagine deve essere di massimo 1MB',
        ]);

        $user = $request->user();
        // Store Avatar
        $filename = $request->userpic->getClientOriginalName(); //Get original file name
        $path = $request->userpic->storeAs('images/avatars',$filename,'public');
            $user->update([
                'image_path' => $path
            ]);

            return response()->json([
                'image' =>  $user->image_path,
                'message' => 'Immagine aggiornata con successo'
            ], 201);
    }

}
