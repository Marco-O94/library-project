<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of users
     *
     * @return \Illuminate\Http\Response
     */

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


    /* Update own user profile */

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            ],
            [
                'name.required' => 'Il nome è obbligatorio',
                'name.string' => 'Il nome deve essere una stringa',
                'name.max' => 'Il nome deve essere di massimo 255 caratteri',
                'email.required' => 'L\'email è obbligatoria',
                'email.string' => 'L\'email deve essere una stringa',
                'email.email' => 'L\'email deve essere un\'email valida',
                'email.max' => 'L\'email deve essere di massimo 255 caratteri',
                'email.unique' => 'L\'email è già stata utilizzata',
                'role.required' => 'Il ruolo è obbligatorio',
            ]
        );
        $user = $request->user();
        if ($user->id === $request->id) {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user = User::where('id', $user->id)->with('role')->first();
            return response()->json([
                'message' => 'Profilo modificato con successo',
                'user' => $user,
            ], 201);
        } else if ($user->id !== $request->id && $user->role->name === 'Librarian') {

            // Request user through token
            $user = User::find($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
            ]);
            $user = User::where('id', $user->id)->with('role')->firstOrFail();
            return response()->json([
                'message' => 'Utente modificato con successo',
                'user' => $user,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Non puoi modificare questo profilo',
            ], 403);
        }
    }


    /* Update image */
    public function updateImage(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'id' => 'required'
            ],
            [
                'image.required' => 'Seleziona un\'immagine',
                'image.image' => 'Il file selezionato non è un\'immagine',
                'image.mimes' => 'Il file selezionato non è un\'immagine',
                'image.max' => 'L\'immagine deve essere di massimo 1MB',
            ]
        );

        //get user from token
        $user = $request->user();
        $filename = $request->image->getClientOriginalName(); //Get original file name
        if ($user->id == $request->id) {
            /* If is the same user */
            $userData = User::find($user->id);
            // Store Avatar
            $path = $request->image->storeAs('images/avatars', $filename, 'public');
            $userData->update([
                'image_path' => $path
            ]);
            $getUser = User::where('id', $user->id)->with('role')->first();
            return response()->json([
                'user' =>  $getUser,
                'message' => 'Immagine aggiornata con successo'
            ], 201);
            /* ------ */
        } else if ($user->id !== $request->id && $user->role->name === 'Librarian') {
            /* If is the librarian */
            $userData = User::find($request->id);
            // Store Avatar
            $path = $request->image->storeAs('images/avatars', $filename, 'public');
            $userData->update(['image_path' => $path]);
            $image = User::where('id', $request->id)->select('image_path')->first();
            return response()->json([
                'image' =>  $image,
                'id' => $request->id,
                'message' => 'Immagine aggiornata con successo'
            ], 201);
            /* ------ */
        } else {
            /* If is not the same user */
            return response()->json([
                'message' => 'Non puoi modificare questa immagine',
            ], 403);
        }
    }

    /**
     *
     * Get Roles
     * @return \Illuminate\Http\Response
     *
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
        $user = User::findOrFail($id);
        $user->delete();
        if ($user->image_path) {
            Storage::disk('public')->delete($user->image_path);
        }
        if (Auth::user()->id == $id) {
            Auth::user()->tokens()->delete();
            return response()->json([
                'isLogged' => false,
                'message' => 'Il tuo profilo è stato eliminato con successo'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Utente eliminato con successo'
            ], 200);
        }
    }

    /**
     *
     * Update user image by Librarian
     *
     * @return \Illuminate\Http\Response
     */
}
