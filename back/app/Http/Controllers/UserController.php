<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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

        return response()->json($users, 201);
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
        $user = User::find($id)->with('role', 'books')->get();

        return response()->json($user, 201);
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

        return response()->json($user, 201);
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
        $user->roles()->sync($request->role_id);
        if($user->roles()->get()->first()->id == 2) {
           $user->student()->update([
               'school' => $request->school,
               'grade' => $request->grade,
               'class' => $request->class,
           ]);
        }

        $user->save();

        return response()->json([
            'message' => 'Utente modificato con successo'
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
        $user->detach();
        $user->delete();

        return response()->json([
            'message' => 'Utente eliminato con successo'
        ], 201);
    }
}
