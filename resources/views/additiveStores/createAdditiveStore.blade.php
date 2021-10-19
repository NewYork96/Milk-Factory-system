@extends('nav')

@section('content')

    <form action="{{route('additiveStores.store')}}" method="post">

        @csrf
        <div class="mb-3  mx-auto col-6">
          <label for="additive" class="form-label">Adalékanyag</label>
          <select id="additive" class="form-select" name="additive" @foreach ($additive as $item)>
              <option value="{{$item -> id}}">
                {{$item -> name}}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3  mx-auto col-6">
            <label for="quantity" class="form-label">Beérkezett mennyiség (kg)</label>
            <input type="text" class="form-control" id="quantity" name="quantity"  value="{{old('quantity')}}">
        </div>
        @error('quantity')
        <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror            
              <div class="mb-3  mx-auto col-6">
                <label for="position" class="form-label">Raktári pozíció</label>
                <select id="position" class="form-select" name="position" @foreach ($drystore as $position)>
                    <option value="{{$position -> id}}">
                      {{$position -> position}}
                      @if ($position -> occupied == 1)
                      {{"(foglalt)"}}
                    @endif
                    </option>
                  @endforeach
                </select>
              </div>
              @error('position')
              <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
              @enderror
        <div class="col-6 mx-auto">
          <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
    
@endsection