@extends('nav')

@section('content')
<div class="container fluid">
    <h1>Felhasználók</h1>
    @can('create', App\Models\User::class)
    <div class="col-1">
        <a href="{{route('users.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
    </div>
    @endcan
    <div class="row  m-auto">
        <div class="col-10  m-auto">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Név</th>
                        <th scope="col">E-mail cím</th>
                        <th scope="col">Beosztás</th>
                        <th scope="col">Funkciók</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       @foreach ($users as $model)
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$model -> name}}</th>
                            <td>{{$model -> email}}</td>
                            <td>{{$model -> role -> role}}</td>
                                <td>
                                @can('view', $model)
                                    <a href="{{route('users.show', $model -> id)}}"><button type="button" class="btn btn-secondary">Mutat</button></a>
                                @endcan
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection