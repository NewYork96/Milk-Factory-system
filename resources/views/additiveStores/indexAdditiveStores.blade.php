@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Adalékanyag raktárkészlet</h1>
    @can('create',  App\Models\AdditiveStore::class)
    <div class="row m-auto">
        <div class="col-1">
            <a href="{{route('additiveStores.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
        </div>
    </div>
    @endcan
    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                
                <thead>
                    <tr>
                        <th scope="col">Megnevezés</th>
                        <th scope="col">Azonosító</th>
                        <th scope="col">Készlet</th>
                        <th scope="col">Pozíció</th>
                        @can('update', App\Models\Additive::class)
                            <th scope="col">Funkció</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($additiveStores as $additiveStore)
                        <tr>
                            <th scope="row">{{$additiveStore -> additive -> name}}</th>
                            <td>#{{$additiveStore -> id}}</td>
                            <td>{{$additiveStore -> quantity}}</td>
                            <td>{{$additiveStore -> dryStore -> position}}</td>
                            @can('update', App\Models\Additive::class)
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{route('additiveStores.destroy', $additiveStore->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-2">Törlés</button>
                                        </form>
                                        <a href="{{route('additiveStores.edit', $additiveStore->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
        @can('create', App\Models\Additive::class)
        @endcan
    </div>
</div>
</div
</div>

@endsection


