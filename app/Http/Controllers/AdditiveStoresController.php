<?php

namespace App\Http\Controllers;

use App\Models\Additive;
use App\Models\AdditiveStore;
use App\Models\DryStore;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdditiveStoresController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this -> authorize('viewAny', AdditiveStore::class);
        $additiveStores = AdditiveStore::all();
        
        return view('additiveStores/indexAdditiveStores', ['additiveStores' => $additiveStores,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', AdditiveStore::class);
        $additive = Additive::all();
        $drystore = DryStore::all();

        return view('additiveStores/createAdditiveStore', ['additive' => $additive, 'drystore' => $drystore]);
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
            'quantity' => ['required', 'numeric'],
            'position' => [Rule::unique('additive_stores', 'dry_store_id'), Rule::exists('dry_stores', 'id')],
            'additive' => ['required', Rule::exists( 'additives', 'id')]            
        ]);
    
               $additiveStore = new AdditiveStore;

                $additiveStore -> additive_id = $request-> additive;

                $additiveStore -> quantity = $request -> quantity;

                $additiveStore -> dry_store_id = $request -> position;

                $additiveStore->save();

                $dryStore = DryStore::find($additiveStore -> dry_store_id);

                $dryStore -> occupied = 1;

                $dryStore -> save();
    
          return redirect(route('additiveStores.index'))->with('success', 'Adalékanyag sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(additiveStore $additiveStore)
    {
        $this -> authorize('update', AdditiveStore::class);
        $additive = Additive::all();
        $dryStore = DryStore::all();
        
        return view('additiveStores/editAdditiveStore', [
            'additiveStore' => $additiveStore,
            'additive' => $additive,
            'dryStore' => $dryStore]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdditiveStore $additiveStore,Request $request)
    {         
        $request -> validate([
            'quantity' => ['required', 'numeric'],
            'position' => [Rule::unique('additive_stores', 'dry_store_id') -> ignore($additiveStore -> id), Rule::exists('dry_stores', 'id')],
            'additive' => [Rule::exists( 'additives', 'id')]
        ]);

        $additiveStore -> quantity = $request -> quantity ;

        $dryStore = DryStore::find($additiveStore -> dry_store_id);
        if ($additiveStore -> dry_store_id != $request -> position) 
        {
            $dryStore -> occupied = 0;
        }
        $dryStore->save();

        $additiveStore -> dry_store_id = $request -> position;
        
        $dryStore = DryStore::find($additiveStore -> dry_store_id);
        $dryStore -> occupied = 1;

        $additiveStore->save();

        $dryStore -> save();


        return redirect(route('additiveStores.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditiveStore $additiveStore)
    {

        $this -> authorize('delete', AdditiveStore::class);

        $dryStore = DryStore::find($additiveStore -> dry_store_id);

        $dryStore -> occupied = 0;

        $additiveStore -> delete();

        $dryStore -> save();

        return redirect() ->route('additiveStores.index');
    }
}