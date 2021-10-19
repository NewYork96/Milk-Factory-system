@extends('nav')

@section('content')
    <form action="{{route('additives.update', $additive -> id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3 mx-auto col-6">
            <label for="name" class="form-label">Adalékanyag neve</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{$additive -> name}}">
        </div>
        @error('name')
        <div class="mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mx-auto col-6 mb-3">
            <label for="provider" class="form-label">Beszállító</label>
                <select id="provider" class="form-select" name="provider" @foreach ($providers as $provider)>
                    <option value="{{$provider -> id}}" @if ($additive -> provider_id == $provider -> id)
                        {{'selected'}}
                    @else
                        {{''}}
                    @endif>
                      {{$provider -> name}}
                    </option>
                    @endforeach>
                </select>
        </div>
        <div class="col-6 mx-auto">
        <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
@endsection