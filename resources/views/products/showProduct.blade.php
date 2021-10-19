@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Termékek</h1>
    @can('create', App\Models\Product::class)
    <div class="row m-auto">
        <div class="col-1">
            <a href="{{route('products.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
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
                        <th scope="col">ÁR</th>
                        <th scope="col">Tejzsír igény / 1000 l</th>
                        <th scope="col">Adalékanyag</th>
                        @can('viewAny', App\Models\Product::class)
                            <th scope="col">Funkciók</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$product -> product}}</th>
                            <td>{{$product -> size}} g</td>
                            <td>{{$product -> best_before}} nap</td>
                            <td>{{$product -> price}} Ft</td>
                            <td>{{$product -> milkfat}} kg</td>
                            <td>
                            @foreach ($product -> additive as $additive)
                                 {{ $additive -> name}} 
                            @endforeach
                            </td>
                            @can('update', App\Models\Product::class)
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger me-3">Törlés</button>
                                    </form>
                                    <a href="{{route('products.edit', $product->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                                </div>
                                </td>
                            @endcan
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection