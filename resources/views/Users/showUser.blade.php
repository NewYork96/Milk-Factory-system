@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Felhasználók</h1>
    @can('create', App\users\user::class)
        <div class="col-1">
            <div class="row m-auto">
                <a href="{{route('users.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
            </div>
        </div>
    @endcan
    <div class="row  m-auto">
        <div class="col-10  m-auto">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Név</th>
                        <th scope="col">E-mail cím</th>
                        <th scope="col">Telefonszám</th>
                        <th scope="col">Jogosultság</th>
                        <th scope="col">Személyi igazolvány szám</th>
                        <th scope="col">Funkciók</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$user -> name}}</th>
                            <td>{{$user -> email}}</td>
                            <td>{{$user -> phone_number}} </td>
                            <td>{{$user -> role -> role}}</td>
                            <td>{{$user -> id_card_number}} </td>
                            <td>
                               @can('delete', $user)
                               <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-3">Törlés</button>
                                </form>
                            </div>
                               @endcan
                                <a href="{{route('users.edit', $user->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection