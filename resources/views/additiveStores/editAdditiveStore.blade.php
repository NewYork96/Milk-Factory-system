@extends('nav')

@section('content')
<form action="{{route('additiveStores.update', $additiveStore)}}" method="post">

    @csrf
    @method('PUT')
    <div>
        <h1 class="mb-3 mx-auto col-6">#{{$additiveStore -> id . ' ' . $additiveStore -> additive -> name}}</h1>
    </div>
    <div class="mb-3 mx-auto col-6">
        <label for="quantity" class="form-label">Adalékanyag neve</label>
        <input type="text" class="form-control" id="quantity" name="quantity"  value="{{$additiveStore -> quantity}}">
    </div>
    @error('quantity')
    <div class="mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
    @enderror            
          <div class="mb-3 mx-auto col-6">
            <label for="position" class="form-label">Beszállító</label>
            <select id="position" class="form-select" name="position" @foreach ($dryStore as $position)>
                <option value="{{$position -> id}}"  @if ($additiveStore -> dry_store_id == $position -> id)
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
          </div>
          @error('position')
            <div class="mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
          @enderror
          <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary mb-3">Mentés</button>
          </div>
  </form>
@endsection