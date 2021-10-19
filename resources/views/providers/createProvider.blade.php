@extends('nav')

@section('content')

    <form action="{{route('providers.store')}}" method="post">

        @csrf
        <div class="mb-3 mx-auto col-6">
            <label for="name" class="form-label">Beszállító neve</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}">
        </div>
        @error('name')
        <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="email" class="form-label">E-mail cím</label>
            <input type="email" class="form-control" id="address" name="email" value="{{old('email')}}">
        </div>
        @error('email')
        <div class="text-danger fs-6  mx-auto col-6">{{$message}}</div>
    @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="address" class="form-label">Cím</label>
            <input type="text" class="form-control" id="address" name="address"  value="{{old('address')}}">
        </div>
        @error('address')
        <div class=" mb-2  text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
       </form>
    
@endsection