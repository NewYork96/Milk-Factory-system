@extends('nav')

@section('content')



    <form action="{{route('productStores.store')}}" method="post">

        @csrf
        <div class="mb-3  mx-auto col-6">
            <label for="product" class="form-label">Beszállító</label>
            <select id="product" class="form-select" name="product" @foreach ($products as $product)>
                <option value="{{$product -> id}}">
                  {{$product -> product}}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3  mx-auto col-6">
              <label for="amount" class="form-label">Készlet</label>
              <input type="text" class="form-control" id="amount" name="amount"  value="{{old('amount')}}">
          </div>
          @error('amount')
            <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
          @enderror
          <div class="mb-3  mx-auto col-6">
            <label for="position" class="form-label">Raktári pozíció</label>
            <select id="position" class="form-select mb-3" name="position" @foreach ($positions as $position)>
                <option value="{{$position -> id}}"> 
                  {{$position -> position}}
                @if ($position -> occupied == 1)
                  {{"(foglalt)"}}
                @endif
                </option>
              @endforeach
            </select>
            @error('position')
              <div class="mb-2 text-danger fs-6">{{$message}}</div>
            @enderror
          </div>
        @foreach ($additiveStores as $additiveStore)
        <div class="form-check  mx-auto col-6">
          <input class="form-check-input" type="checkbox" value="{{$additiveStore -> id}}" name="additives[]" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            {{$additiveStore -> id . ', ' . $additiveStore -> additive -> name}}
          </label>
        </div>
        @endforeach
        <div class="col-6 mx-auto">
          <button type="submit" class="btn btn-primary my-3">Mentés</button>
        </div>
    </form>
@endsection