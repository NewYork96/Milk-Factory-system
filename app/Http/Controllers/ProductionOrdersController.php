<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrder;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class productionOrdersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this -> authorize('viewAny', ProductionOrder::class);
        $all = ProductionOrder::all();
        $table = 'productionOrders';
        
        return view('productionOrders/indexproductionOrders', ['all' => $all,
                                  'table' => $table]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this -> authorize('create', ProductionOrder::class);
        $product = Product::all();

        return view('productionOrders/createProductionOrder', ['product' => $product]);
    }

    /**
     * Show the form for calculating  a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request, Product $product)
    {        
        $request -> validate([
            'planned_amount' => ['numeric'],
            'product' => [Rule::exists('products', 'id')]
        ]);
        $product = Product::find($request -> product);
        
        $milk = ($request -> planned_amount) * ($product -> size) / 1000;
        $milkfat = $milk / 1000 * $product -> milkfat;
        
        $now = Carbon::now()->addDays($product -> best_before);
        $formatted = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y-m-d');

        return view('productionOrders/calculateproductionOrder', [
            'milk' => $milk,
            'milkfat' => $milkfat,
            'product' => $product, 
            'request' => $request,
            'formatted' => $formatted
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
            'planned_amount' => ['numeric'],
            'product_id' => [Rule::exists('products', 'id')],
            'best_before' => ['date_format:Y-m-d'],
            'milk' => ['numeric'],
            'milkfat' => ['numeric']

        ]);
               
                $productionOrder = new ProductionOrder;

                $productionOrder -> product_id  = $request -> product_id;
                
                $productionOrder -> planned_amount = $request -> planned_amount;
                
                $productionOrder -> best_before = $request -> best_before;
                
                $productionOrder -> milk = $request -> milk;
                
                $productionOrder -> milkfat = $request -> milkfat;

                $productionOrder->save();
    
          return redirect(route('productionOrders.index'))->with('success', 'Termelési igény sikeresen létrehozva!');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductionOrder $productionOrder)
    {       
        $this -> authorize('update', ProductionOrder::class);
        
        $products = Product::all();

        return view('productionOrders/editproductionOrder', [
            'productionOrder' => $productionOrder,
            'products' => $products
            ]);
    }

    public function calculateUpdate(Request $request, ProductionOrder $productionOrder)
    {
        $request -> validate([
            'planned_amount' => ['numeric'],
            'product' => [Rule::exists('products', 'id')]
        ]);

        $request -> validate(['planned_amount' => ['numeric']]);
        $product = Product::find($request -> product);
        
        $milk = ($request -> planned_amount) * ($product -> size) / 1000;
        $milkfat = $milk / 1000 * $product -> milkfat;
        
        $now = Carbon::now()->addDays($product -> best_before);
        $formatted = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y-m-d');

        return view('productionOrders/calculateproductionOrderUpdate', [
            'productionOrder' => $productionOrder,
            'milk' => $milk,
            'milkfat' => $milkfat,
            'product' => $product, 
            'request' => $request,
            'formatted' => $formatted
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductionOrder $productionOrder, Request $request)
    {         
        $request -> validate([
            'planned_amount' => ['numeric'],
            'product_id' => [Rule::exists('products', 'id')],
            'best_before' => ['date_format:Y-m-d'],
            'milk' => ['numeric'],
            'milkfat' => ['numeric']

        ]);
            
        $productionOrder -> product_id  = $request -> product_id;
        $productionOrder -> planned_amount = $request -> planned_amount;
        $productionOrder -> best_before = $request -> best_before;
        $productionOrder -> milk = $request -> milk;
        $productionOrder -> milkfat = $request -> milkfat;

        $productionOrder->save();


        return redirect(route('productionOrders.index'))->with('successEdit', 'A módosítás sikeres módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(productionOrder $productionOrder)
    {
        $this -> authorize('delete', ProductionOrder::class);
        $productionOrder -> delete();

        return redirect() ->route('productionOrders.index');
    }
}
