@extends('nav')

@section('content')

<div class="container fluid">
    <h1>Tej raktárkészlet</h1>
    <div class="row m-auto">
        <div class="col-10 m-auto">
            <table class="table table-bordered text-center">
                
                <thead>
                    <tr>
                        <th scope="col">Tejkészlet</th>
                        <th scope="col">Tejzsír készlet</th>
                        @can('update', App\Models\Milkstore::class)
                            <th scope="col">Funkciók</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <tr>
                            <a href=""></a>
                            <td>{{$milk -> milk}}</td>
                            <td>{{$milk ->milkfat}}</td>
                            @can('update', App\Models\Milkstore::class)
                                <td>
                                    <a href="{{route('milkStore.edit', $milk->id)}}"><button type="button" class="btn btn-secondary">Módosítás</button></a>
                                </td>
                            @endcan
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>

@endsection