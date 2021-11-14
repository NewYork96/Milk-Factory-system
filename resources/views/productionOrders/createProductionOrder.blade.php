@extends('nav')

@section('content')
    <form action="/productionOrders/calculate" method="get">
        @csrf
        @method('GET')
        <div class="mb-3  mx-auto col-6">
            <label for="product" class="form-label">Termék</label>
            <select id="product" class="form-select" name="product" @foreach ($product as $item)>
                <option value="{{$item -> id}}">
                  {{$item -> product}}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3  mx-auto col-6">
            <label for="planned_amount" class="form-label">Tervezett termelt mennyiség</label>
            <input type="text" class="form-control" id=planned_amount" name="planned_amount"  value="{{old('planned_amount')}}">
        </div>
        @error('planned_amount')
          <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="col-6 mx-auto">
          <button type="submit" class="btn btn-primary mb-3">Kalkuláció</button>
        </div>
    </form>
@endsection