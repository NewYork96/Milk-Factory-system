@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Termelés tervezet</h1>
    @can('create', App\Models\productionOrder::class)
    <div class="row m-auto">
        <div class="col-1">
            <a href="{{route('productionOrders.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
        </div>
    </div>
        @endcan
    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                
                <thead>
                    <tr>
                        <th scope="col">Termék</th>
                        <th scope="col">Tej igény</th>
                        <th scope="col">Tejzsír igény</th>
                        <th scope="col">Tervezett termelt mennyiség</th>
                        <th scope="col">Eltarthatóság</th>
                        <th scope="col">Adalékanyagok</th>
                        <th scope="col">Funkciók</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       @foreach ($all as $order)
                        <tr>
                            <a href=""></a>
                            <th scope="row">{{$order -> product -> product}}</th>
                            <td>{{$order -> milk}}</td>
                            <td>{{$order -> milkfat}}</td>
                            <td>{{$order -> planned_amount}}</td>
                            <td>{{$order -> best_before}}</td>
                            <td>@foreach ($order -> product -> additive as $additive)
                                {{$additive -> name}}
                            @endforeach
                            @can('update', App\Models\productionOrder::class)
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('productionOrders.destroy', $order->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger me-3">Törlés</button>
                                    </form>
                                    <a href="{{route('productionOrders.edit', $order->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                                </div>
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