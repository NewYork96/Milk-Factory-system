<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('users/indexUsers', ['users' => $users]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $this ->authorize('view', $user);
        return view('users/showUser', ['user' => $user]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this ->authorize('create', User::class);
        $roles = Role::all();

        return view('users/createUser', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email',Rule::unique('users')],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone_number' => ['required', 'numeric'],
            'id_card_number' => ['required', 'regex:/[0-9]{6}[A-Z]{2}/', Rule::unique('users')],
            'role' => [Rule::exists('roles', 'id')]
          ]);

                $user = new User();
                
                $user -> name  = $request-> name;

                $user -> email = $request -> email;

                $user -> password = Hash::make($request-> password);

                $user -> phone_number = $request -> phone_number;

                $user -> id_card_number = $request -> id_card_number;

                $user -> role_id = $request -> role;

                $user->save();
    
          return redirect(route('users.index'))->with('success', 'Felhasználó sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {        
        $this ->authorize('update', $user);

        $roles = Role::all();

        return view('Users/editUser', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,Request $request)
    {   
        $request -> validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email',Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['required', 'numeric'],
            'password' => ['nullable','confirmed', 'min:8'],
            'id_card_number' => ['required',  Rule::unique('users') -> ignore($user -> id), 'regex:/[0-9]{6}[A-Z]{2}/'],
            'role' => [Rule::exists('roles', 'id')]
          ]);
    
                $user -> name  = $request-> name;

                $user -> email = $request -> email;

                $user -> phone_number = $request -> phone_number;

                $user -> id_card_number = $request -> id_card_number;

                if ($request -> password === NULL) {
                    $user -> password = $user -> password;
                 } else {
                     $user -> password = $request -> password;
                 }
 

                if ($request -> role === NULL) {
                   $user -> role_id = $user -> role_id;
                } else {
                    $user -> role_id = $request -> role;
                }

                $user->save();


        return redirect(route('users.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user )
    {
        $this ->authorize('delete', User::class);
        $user -> delete();

        return redirect() ->route('users.index');
    }
}
