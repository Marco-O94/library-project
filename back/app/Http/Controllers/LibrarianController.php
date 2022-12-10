<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class LibrarianController extends Controller
{

    /**
     * Display Users list
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $users = User::when($request->input('search') ?? '', function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")->orderBy('name', 'asc');
        })
            ->when($request->input('role') ?? '', function ($query, $role) {
                $query->whereHas('role', function ($query) use ($role) {
                    $query->where('name', $role);
                });
            })
            ->with('role')
            ->withCount('books')
            ->paginate(10);

        return response()->json($users, 200);
    }

    /**
     * Display single user to edit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('role', 'books')->first();
        return response()->json($user, 200);
    }

    /**
     * Update user profile by Librarian
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $request->id,
        ]);

        // Request user through token
        $user = $request->id;
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

    /**
     *
     * Update user image by Librarian
     *
     * @return \Illuminate\Http\Response
     */

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

        $user = $request->id;
        // Store Avatar
        $filename = $request->userpic->getClientOriginalName(); //Get original file name
        $path = $request->userpic->storeAs('images/avatars', $filename, 'public');
        $user->update([
            'image_path' => $path
        ]);

        // Return User with role
        $user = User::where('id', $request->id)->with('role')->first();

        return response()->json([
            'user' =>  $user,
            'message' => 'Immagine aggiornata con successo'
        ], 201);
    }

    /**
     *
     * Get Roles
     *
     * @return \Illuminate\Http\Response
     */

    public function roles()
    {
        $roles = Role::select('name', 'id')->get(); // Return array of roles
        return response()->json($roles, 200);
    }

    /**
     * Remove user from database
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
        ], 200);
    }
}
