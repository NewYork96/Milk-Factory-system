@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Termékek</h1>
    @can('create', App\Models\Product::class)
    <div class="row m-auto">
        <div class="col-1">
            <a href="{{route('products.create')}}"><button type="button" class="btn m-3 btn-primary">Új</button></a>
        </div>        
    </div>
    @endcan    
    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                
                <thead>
                    <tr>
                        <th scope="col">Termék</th>
                        <th scope="col">Kiszerelés</th>
                        <th scope="col">Eltarthatóság</th>
                        @can('viewAny', App\Models\Product::class)
                            <th scope="col">Funkciók</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       @foreach ($products as $product)
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$product -> product}}</th>
                            <td>{{$product -> size}} g</td>
                            <td>{{$product -> best_before}} nap</td>
                            @can('viewAny', App\Models\Additive::class)
                                <td>
                                    <a href="{{route('products.show', $product->id)}}"><button type="button" class="btn btn-secondary">Mutat</button></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection