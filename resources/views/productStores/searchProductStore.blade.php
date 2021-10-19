@extends('nav')

@section('content')
<h1>Késztermék Készlet</h1>
    <form action="{{route('productStores.index')}}" method="GET">
        @method('GET')
        @csrf
        @can('create', App\Models\ProductStore::class)
        <div class="row m-auto">
            <div class="col-1">
                <a href="{{route('productStores.create')}}"><button type="button" class="btn btn-primary m-3">Új</button></a>
            </div>
        </div>
        @endcan          
            <div class="mb-3 mx-auto col-6">
            <label for="product" class="form-label">Keresett termék</label>
            <select id="product" class="form-select" name="product" @foreach ($produtStores as $productStore)>
                <option value="{{$productStore -> id}}">
                    {{$productStore -> product}}
                </option>
                @endforeach
            </select>
            </div>
            <div class="col-6 mx-auto">
                <button type="submit" class="btn btn-primary mb-3">Keresés</button>
            </div>
        </form>
    
@endsection