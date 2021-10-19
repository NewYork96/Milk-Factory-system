<?php

namespace App\Http\Controllers;

use App\Models\AdditiveStore;
use App\Models\coldstore;
use App\Models\Product;
use App\Models\ProductStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class productStoresController extends Controller
{
    public function search() 
    {
        $produtStores = collect(Product::all());
        
        return view('productStores/searchProductStore', ['produtStores' => $produtStores]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::find($request -> product);
        
        $productStore = ProductStore::where('product_id', $product -> id) -> get();
        $collect = collect($productStore);
        
        if ($collect -> isEmpty()) {
            return back() ->with('notFound', 'Ilyen termék nincs készleten!');
        } else {
        return view('productStores/indexProductStores', ['productStore' => $productStore, 'product' => $product, 'collect' => $collect]);
        }
    }

    public function show(ProductStore $productStore)
    {
        $this -> authorize('viewAny', ProductStore::class);
        return view('productStores/showProductStore', ['productStore' => $productStore]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', ProductStore::class);
        $products = Product::all();
        $positions = Coldstore::all();
        $additiveStores = AdditiveStore::all();

        return view('productStores/createProductStore', [
            'products' => $products,
            'positions' => $positions,
            'additiveStores' => $additiveStores
        ]);
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
            'product' => [Rule::exists('products', 'id')],
            'amount' => ['required', 'numeric'],
            'position' => [Rule::unique('product_stores', 'coldstore_id'), Rule::exists('coldstores', 'id')],
            'best_before' => ['numeric']
          ]);

            $product = Product::find($request -> product);
            $best_before = Carbon::now()->addDays($product -> best_before);

               $productStore = new ProductStore;

                $productStore -> product_id  = $request -> product;

                $productStore -> amount = $request -> amount;

                $productStore -> best_before = $best_before;

                $productStore -> coldstore_id = $request -> position;

                $productStore -> save();

                $coldstore = Coldstore::find($productStore -> coldstore_id);

                $coldstore -> occupied = 1;

                $coldstore -> save();

                if ($request -> additives != NULL) 
                {
                    foreach ($request -> additives as $additive) {
                        $productStore -> additiveStore() ->attach($additive);
                    }
                }
    
          return redirect('/')->with('success', 'Termék sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductStore $productStore)
    {   
        $this -> authorize('updateAmountAndPosition', ProductStore::class);
        $product = Product::all();
        $positions = Coldstore::all();
        $additiveStores = AdditiveStore::all();
        $results = DB::select("select * from additive_store_product_store");

        return view('productStores/editproductStore', [
        'productStore' => $productStore,
        'product' => $product,
        'positions' => $positions,
        'additiveStores' => $additiveStores,
        'results' => $results
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStore $productStore, Request $request)
    {         
        $request -> validate([
            'product' => [Rule::exists('products', 'id')],
            'amount' => ['required', 'numeric'],
            'position' => [Rule::unique('product_stores', 'coldstore_id') -> ignore($productStore)], Rule::exists('coldstores', 'id'),
            'best_before' => ['numeric']
          ]);


                $productStore -> amount = $request -> amount;

                foreach ($productStore -> additiveStore as $additive) 
                {
                    $additive -> productStore() -> detach();
                }

                $coldStore = ColdStore::find($productStore -> coldstore_id);

                if ($productStore -> coldstore_id != $request -> position) 
                {
                    $coldStore -> occupied = 0;
                }
                $coldStore->save();

                $productStore -> coldstore_id = $request -> position;

                $coldStore = Coldstore::find($productStore -> coldstore_id);
                $coldStore -> occupied = 1;

                $coldStore -> save();

                $productStore->save();

                if ($request -> additives != NULL) 
                {
                    foreach ($request -> additives as $additive) {
                        $productStore -> additiveStore() ->attach($additive);
                    }
                }


                return redirect(route('productStores.show', $productStore)) -> with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductStore $productStore)
    {
        $this -> authorize('delete', ProductStore::class);
        $productStore -> delete();

        return redirect('/')->with('successDelete', 'A törlés sikeres volt!');
    }
}
