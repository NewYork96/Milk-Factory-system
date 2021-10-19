@extends('nav')

@section('content')
    {{$product -> additive_id1}}
    <form action="{{route('products.update', $product)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3  mx-auto col-6">
            <label for="product" class="form-label">Termék megnevezése</label>
            <input type="text" class="form-control" id="product" name="product"  value="{{$product -> product}}">
        </div>
        @error('product')
        <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3  mx-auto col-6">
            <label for="size" class="form-label">Kiszerelés</label>
            <input type="text" class="form-control" id="size" name="size" value="{{$product -> size}}">
        </div>
        @error('size')
            <div class="text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3  mx-auto col-6">
            <label for="best_before" class="form-label">Eltarthatóság</label>
            <input type="text" class="form-control" id="best_before" name="best_before"  value="{{$product -> best_before}}">
        </div>
        @error('best_before')
            <div class=" mb-2  text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3  mx-auto col-6">
            <label for="price" class="form-label">Ár</label>
            <input type="text" class="form-control" id="price" name="price"  value="{{$product -> price}}">
        </div>
        @error('price')
            <div class=" mb-2  text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3  mx-auto col-6">
            <label for="milkfat" class="form-label">Tejzsír igény / 1000 l</label>
            <input type="text" class="form-control" id="milkfat" name="milkfat"  value="{{$product -> milkfat}}">
        </div>
        @foreach ($additives as $additive)
        <div class="form-check  mx-auto col-6">
          <input class="form-check-input" type="checkbox" value="{{$additive -> id}}" name="additives[]" id="flexCheckDefault"@foreach ($product -> additive as $productAdditive)
            @if ($additive -> id == $productAdditive -> id)
                {{"checked"}}
            @endif
          @endforeach>
          <label class="form-check-label" for="flexCheckDefault">
            {{$additive -> name}}
          </label>
        </div>
        @endforeach
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary my-3">Mentés</button>
        </div>
    </form>
    
@endsection