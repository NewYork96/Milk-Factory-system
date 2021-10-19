<?php

namespace App\Http\Controllers;

use App\Models\MilkStore;
use Illuminate\Http\Request;

class MilkController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this -> authorize('viewAny', Milkstore::class);
        $milk = MilkStore::first();
        
        return view('milkStore/indexMilkstore', ['milk' => $milk,]);
    }

    public function edit(MilkStore $milkStore)
    {
        $this -> authorize('update', Milkstore::class);
        $milk = MilkStore::first();
        return view('milkStore/editMilkStore', ['milkstore' => $milkStore]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MilkStore $milkStore)
    {         
        $request -> validate([
            'milk' => ['numeric'],
            'milkfat' => ['numeric'],
        ]);

          $milkStore -> milk = $request -> milk ;
          $milkStore -> milkfat = $request -> milkfat;

        $milkStore->save();


        return redirect(route('milkStore.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }
}
