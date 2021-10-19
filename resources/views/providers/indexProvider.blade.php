@extends('nav')

@section('content')
    <h1>Beszállítók</h1>
    @can('create', App\Models\Additive::class)
        <div class="row m-auto">
            <div class="col-1">
                <a href="{{route('providers.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
            </div>
        </div>
    @endcan

    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Név</th>
                        <th scope="col">Cím</th>
                        <th scope="col">E-mail cím</th>
                        <th scope="col">Funkciók</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       @foreach ($providers as $provider)
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$provider -> name}}</th>
                            <td>{{$provider -> address}}</td>
                            <td>{{$provider -> email}}</td>
                            <td>
                                @can('update', App\Models\Additive::class)
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <form action="{{route('providers.destroy', $provider->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn me-2 btn-danger">Törlés</button>
                                </form>
                                <a href="{{route('providers.edit', $provider->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                            </div>
                            @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>

@endsection