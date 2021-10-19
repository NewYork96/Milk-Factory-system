@extends('nav')

@section('content')



    <form action="{{route('productionOrders.update', $productionOrder)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3 mx-auto col-6">
            <input type="text" class="form-control invisible" id="product_id" name="product_id"  value="{{$product -> id}}" >
        </div>   
        <div class="mb-3 mx-auto col-6">
            <label for="product" class="form-label">Termék</label>
            <input type="text" class="form-control" id="product" name="product"  value="{{$product -> product}}" >
        </div>
        <div class="mb-3 mx-auto col-6">
            <label for="planned_amount" class="form-label">Tervezett termelt mennyiség (darabban):</label>
            <input type="text" class="form-control" id=planned_amount" name="planned_amount"  value="{{$request -> planned_amount}}">
        </div>
        <div class="mb-3 mx-auto col-6">
            <label for="milk" class="form-label">Szükséges tej (literben): </label>
            <input type="text" class="form-control" id="milk" name="milk"  value="{{$milk}}" >
        </div>
        <div class="mb-3 mx-auto col-6">
            <label for="milkfat" class="form-label">Szükséges tejzsír (kilogrammban): </label>
            <input type="text" class="form-control" id="milkfat" name="milkfat"  value="{{$milkfat}}" >
        </div>
        <div class="mb-3 mx-auto col-6">
            <label for="best_before" class="form-label">Lejárati idő</label>
            <input type="text" class="form-control" id="best_before" name="best_before"  value="{{$formatted}}" >
        </div>
        <div class="mx-auto col-6">
            @foreach ($product -> additive as $additive)
                <p>{{$additive -> name}}</p>
            @endforeach
        </div>
        <div class="col-6 mx-auto">
        <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
@endsection