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
                        <th scope="col">Kiszerelés</th>
                        <th scope="col">Szavatossági idő</th>
                        <th scope="col">Készlet</th>
                        <th scope="col">Ár</th>
                        <th scope="col">Pozíció</th>
                        <th scope="col">Adalékanyag</th>
                        @can('updateAmountAndPosition', App\Models\productStore::class)
                        <th scope="col">Funkciók</th>
                        </tr>
                        @endcan
                </thead>
                <tbody>
                    <tr>
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$productStore -> product -> product}}</th>
                            <td>{{$productStore -> product -> size}} g</td>
                            <td>{{$productStore -> best_before}}</td>
                            <td>{{$productStore -> amount}}</td>
                            <td>{{$productStore -> product -> price}}</td>
                            <td>{{$productStore -> coldstore -> position}}</td>
                            <td>@foreach ($productStore -> additiveStore as $additiveStore)
                                {{ '#' . $additiveStore -> id . ', '}}
                            @endforeach
                                @can('delete', App\Models\productStore::class)
                                <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('productStores.destroy', $productStore->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn me-2 btn-danger">Törlés</button>
                                    </form>
                                @endcan
                                @can('updateAmountAndPosition', App\Models\productStore::class)
                                    <a href="{{route('productStores.edit', $productStore -> id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
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