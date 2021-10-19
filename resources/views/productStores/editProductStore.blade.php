@extends('nav')

@section('content')



    <form action="{{route('productStores.update', $productStore)}}" method="post" class="justify-content-center">

        @csrf
        @method('PUT')
        @can('update', App\Models\productStore::class)
            <div class="mb-3 mx-auto col-6">
                <label for="product" class="form-label">Termék</label>
                <select id="product" class="form-select" name="product" @foreach ($product as $item)>
                    <option value="{{$item -> id}}" @if ($productStore -> product_id == $item -> id)
                        {{'selected'}}
                    @else
                        {{''}}
                    @endif>
                    {{$item -> product}}
                    </option>
                    @endforeach>
                    <option>
                    </option>
                </select>
            </div>
          @endcan
          <div class="mb-3 mx-auto col-6">
              <label for="amount" class="form-label">Készlet</label>
              <input type="text" class="form-control" id="amount" name="amount"  value="{{$productStore -> amount}}">
          </div>
          @error('amount')
            <div class="mb-2 text-danger fs-6 ">{{$message}}</div>
          @enderror
          <div>
          </div>
          <div class="mx-auto col-6 mb-3">
            <label for="position" class="form-label">Raktári pozíció</label>
            <select id="position" class="form-select" name="position" @foreach ($positions as $position)>
                <option value="{{$position -> id}}" @if ($productStore -> coldstore_id == $position -> id)
                    {{'selected'}}
                @else
                    {{''}}
                @endif>
                  {{$position -> position}}
                  @if ($position -> occupied == 1)
                  {{"(foglalt)"}}
                @endif
                </option>
                @endforeach
            </select>
            @error('position')
              <div class="mb-2 text-danger fs-6 ">{{$message}}</div>
            @enderror
          </div>
            @can('update', App\Models\productStore::class)
              @foreach ($additiveStores as $additiveStore)
            <div class="form-check mx-auto col-6">
            <input class="form-check-input" type="checkbox" value="{{$additiveStore -> id}}" name="additives[]" id="flexCheckDefault"
            @foreach ($productStore -> additiveStore as $productStoreAdditiveStore)
              @if ($additiveStore -> id == $productStoreAdditiveStore -> id)
                  {{"checked"}}
              @endif
          @endforeach>
            <label class="form-check-label" for="flexCheckDefault">
              {{$additiveStore -> id . ', ' . $additiveStore -> additive -> name}}
            </label>
          </div>
          @endforeach
          @error('amount')
            <div class="mb-2 text-danger fs-6 ">{{$message}}</div>
          @enderror
        @endcan
        <div class="col-6 mx-auto mt-3">
          <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
@endsection