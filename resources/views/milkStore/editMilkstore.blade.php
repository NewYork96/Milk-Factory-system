@extends('nav')

@section('content')

    <form action="{{route('milkStore.update', $milkstore)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3 mx-auto col-6">
            <label for="milk" class="form-label">Tejkészlet</label>
            <input type="text" class="form-control" id="milk" name="milk"  value="{{$milkstore  -> milk}}">
        </div>
        @error('milk')
            <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="milkfat" class="form-label">Tejzsír készlet</label>
            <input type="text" class="form-control" id="amilkfat" name="milkfat" value="{{$milkstore -> milkfat}}">
        </div>
        @error('milkfat')
            <div class="mb-2 text-danger fs-6  mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
    
@endsection