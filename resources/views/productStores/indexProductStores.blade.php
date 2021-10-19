@extends('nav')

@section('content')
<div class="container fluid">
    <h1>Késztermék Készlet</h1>
    @can('create', App\Models\ProductStore::class)
    <div class="row m-auto">
        <div class="col-1">
            <a href="{{route('productStores.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
        </div>
    </div>
    @endcan
    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Termék</th>
                        <th scope="col">Szavatossági idő</th>
                        <th scope="col">Készlet</th>
                        @can('viewAny', App\Models\productStore::class)
                            <th scope="col">Funkciók</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       @foreach ($productStore as $productStore)
                        <tr>
                           <th scope="row">{{$productStore -> product -> product}}</th>
                            <td>{{$productStore -> best_before}}</td>
                            <td>{{$productStore -> amount}}</td>
                            @can('viewAny', App\Models\ProductStore::class)
                                <td>
                                    <a href="{{route('productStores.show', $productStore -> id)}}"><button type="button" class="btn btn-secondary">Mutat</button></a>
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