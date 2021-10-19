<?php

namespace App\Http\Controllers;

use App\Models\Additive;
use App\Models\Product;
use App\Models\ProductionOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();;
        
        return view('products/indexProducts', ['products' => $products,]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function show(Product $product)
    {
        $this -> authorize('viewAny', Product::class);
        
        return view('products/showProduct', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', Product::class);
        $additives = Additive::all();
        return view('products/createProduct', ['additives' => $additives]);
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
            'product' => ['required', 'min:3', 'max:100', Rule::unique( 'products', 'product')],
            'size' => ['required', 'numeric', 'min:150', 'max:5000'],
            'best_before' => ['required', 'numeric', 'min:7', 'max:40'],
            'price' => ['required', 'numeric'],
            'milkfat' => ['required', 'numeric']
          ]);
    
               $product = new Product;

                $product -> product  = $request->product;

                $product -> size = $request -> size;

                $product -> best_before = $request -> best_before;

                $product -> price = $request -> price;

                $product -> milkfat = $request -> milkfat;

                $product->save();

                if ($request -> additives != NULL) 
                {
                    foreach ($request -> additives as $additive) {
                        $product -> additive() ->attach($additive);
                    }
                }
    

    
          return redirect(route('products.index'))->with('success', 'Termék sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {        
        $this -> authorize('update', Product::class);
        $additives = Additive::all();

        return view('products/editproduct', [
            'product' => $product,
            'additives' => $additives,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {         
        $request -> validate([
            'product' => ['required', 'min:3', 'max:100', Rule::unique( 'products', 'product') -> ignore($product -> id)],
            'size' => ['required', 'numeric', 'min:150', 'max:5000'],
            'best_before' => ['required', 'numeric', 'min:7', 'max:40'],
            'price' => ['required', 'numeric'],
          ]);

                $product -> product  = $request->product;

                $product -> size = $request -> size;

                $product -> best_before = $request -> best_before;

                $product -> price = $request -> price;

                $product -> milkfat = $request -> milkfat;

                foreach ($product -> additive as $additive) 
                {
                    $additive -> product() -> detach();
                }

                if ($request -> additives != NULL) 
                {
                    foreach ($request -> additives as $additive) {
                        $product -> additive() ->attach($additive);
                    }
                }
                
        return redirect(route('products.index'))->with('successEdit', 'A módosítás sikeres volt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
            $this -> authorize('delete', Product::class);
            $additive = Additive::all();

            $productionOrders = ProductionOrder::all();
        
            foreach ($productionOrders as $productionOrder) {
                if ($productionOrder -> product -> id == $product -> id) {
                    return back() ->with('couldNotDelete', 'Nem lehet törölni, mivel használatban van!');
                } 
            }    

            foreach ($product -> additive as $additive) 
            {
                $additive -> product() -> detach();
            };

            $product -> delete();

        return redirect() ->route('products.index')->with('successDelete', 'A törlés sikeres volt!');
    }
}
