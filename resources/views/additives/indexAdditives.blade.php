@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Adalékanyagok</h1>
    @can('create', App\Models\Additive::class)
    <div class="row m-auto">
        <div class="col-1">
                <a href="{{route('additives.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
            </div>
        </div>
        @endcan
    <div class="row  m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                
                <thead>
                    <tr>
                        <th scope="col">Megnevezés</th>
                        <th scope="col">Beszállító</th>
                        @can('update', App\Models\Additive::class)
                            <th scope="col">Funkciók</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($additives as $additive)
                        <tr>
                            <th scope="row">{{$additive -> name}}</th>
                            <td>{{$additive -> provider -> name}}</td>
                             @can('update', App\Models\Additive::class)
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('additives.destroy', $additive->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger me-3">Törlés</button>
                                    </form>
                                    <a href="{{route('additives.edit', $additive->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                            @endcan
                                </div>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


