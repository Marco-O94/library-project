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

        return response()->json([$users], 201);
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

        return response()->json([$user], 201);
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

        return response()->json([$user], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validateWithBag('updateUser', [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$id,
            'is_admin' => 'boolean',

        ]);

        $user = User::find($id);
        //Edit user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        $user->role()->update([
            'role_id' => $request->role_id,
        ]);

        if($user->role()->select('name')->get() === 'Student') {
           $user->student()->update([
               'school' => $request->school,
               'grade' => $request->grade,
               'class' => $request->class,
           ]);
        }

        $user->save();

        return response()->json([$user], 201);
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

    public function updateImage(Request $request)
    {
        $request->validateWithBag('changeImage', [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'image.required' => 'Seleziona un\'immagine',
            'image.image' => 'Il file selezionato non è un\'immagine',
            'image.mimes' => 'Il file selezionato non è un\'immagine',
            'image.max' => 'L\'immagine deve essere di massimo 1MB',
        ]);

        $user = User::find($request->id);

        // Store Avatar
        if ($request->hasFile('image')) {
            $path = $request->file('avatar')->storeAs(
                'avatar_user', $request->user()->id
            );
            $user->image_path = $path;
            $user->save();
            $user->role = $user->role()->get();

            return response()->json([$user], 201);
        } else {
            return response()->json([
                'message' => 'Errore nel caricamento dell\'immagine'
            ], 201);
        }


    }
}
