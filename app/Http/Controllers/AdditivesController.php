<?php

namespace App\Http\Controllers;

use App\Models\Additive;
use App\Models\AdditiveStore;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdditivesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this -> authorize('viewAny', Additive::class);
        $additives = Additive::all();
        
        return view('additives/indexAdditives', ['additives' => $additives,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', Additive::class);
        $provider = Provider::all();

        return view('additives/createAdditive', ['provider' => $provider]);
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
            'name' => ['required', Rule::unique( 'additives', 'name')],
            'provider' => ['required', Rule::exists( 'providers', 'id')], 
            
          ]);
    
               $additive = new Additive;

                $additive ->name  = $request->name;

                $additive -> provider_id = $request -> provider;

                $additive->save();
    
          return redirect(route('additives.index'))->with('success', 'Adalékanyag sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Additive $additive)
    {
        $this -> authorize('update', Additive::class);
        $providers = Provider::all();
        
        return view('additives/editAdditive', ['additive' => $additive, 'providers' => $providers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Additive $additive, Request $request)
    {         
            $request -> validate([
                'name' => ['required', 'min:3', 'max:100',  Rule::unique( 'Additives', 'name')->ignore($additive->id)],
                'provider' => ['required', Rule::exists( 'providers', 'id')],
                ]);


          $additive -> name = $request -> name ;
          $additive -> provider_id = $request -> provider;

        $additive->save();


        return redirect(route('additives.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Additive $additive)
    {

        $this -> authorize('delete', Additive::class);

        $additiveStores = AdditiveStore::all();
        
        foreach ($additiveStores as $additiveStore) {
            if ($additiveStore -> additive -> id == $additive -> id) {
                return back() ->with('couldNotDelete', 'Nem lehet törölni, mivel használatban van!');
            } 
        }
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($product -> additive as $productAadditive) {
                if ($productAadditive -> id == $additive -> id) {
                    return back() ->with('couldNotDelete', 'Nem lehet törölni, mivel használatban van!');
                } 
            }
        }    

            $additive -> delete();
    
            return redirect() ->route('additives.index');
        }
}
