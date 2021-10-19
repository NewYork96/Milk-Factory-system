<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this -> authorize('viewAny', Provider::class);
        $providers = Provider::all();
        
        return view('providers/indexProvider', ['providers' => $providers,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', Provider::class);
        return view('providers/createProvider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request -> validate([
            'name' => ['required', 'min:3', 'max:100',  Rule::unique( 'providers', 'name')], 
            'address' => ['required'],
            'email' => ['required', 'email', Rule::unique( 'providers', 'email')]
          ]);
    
          Provider::create($attributes);
    
          return redirect(route('providers.index'))->with('success', 'Beszállító sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $this -> authorize('update', Provider::class);
        return view('providers/editProvider', ['provider' => $provider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Provider $provider,Request $request)
    {         
            $request -> validate([
        'name' => ['required', 'min:3', 'max:100',  Rule::unique( 'providers', 'name')->ignore($provider->id)], 
        'address' => ['required'],
        'email' => ['required', 'email',Rule::unique('providers')->ignore($provider->id)]
            ]);

          $provider -> name = $request -> name ;
          $provider -> email = $request-> email;
          $provider -> address = $request -> address;

        $provider->save();


        return redirect(route('providers.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $this -> authorize('delete', Provider::class);
        $provider -> delete();

        return redirect() ->route('providers.index')->with('successDelete', 'Sikeres törlés!');
    }
}
