@extends('nav')

@section('content')

    <form action="{{route('users.store')}}" method="post">
        @csrf
        @method('POST')
        <div class="mb-3 mx-auto col-6">
            <label for="name" class="form-label">Név</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}">
        </div>
        @error('names')
          <div class="mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="email" class="form-label">E-mail cím</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
        </div>
        @error('email')
          <div class="text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
        <label for="password" class="form-label">Jelszó</label>
        <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        @error('password')
        <div class="text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="password_confirmation" class="form-label">Jelszó újra</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
        </div>
        <div class="mb-3 mx-auto col-6">
            <label for="phone_number" class="form-label">Telefonszám</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"  value="{{old('phone_number')}}">
        </div>
        @error('phone_number')
            <div class=" mb-2  text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="id_card_number" class="form-label">Szemlyi igazolvány szám</label>
            <input type="text" class="form-control" id="id_card_number" name="id_card_number"  value="{{old('phone_number')}}">
        </div>
        @error('id_card_number')
            <div class=" mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mx-auto col-6">
            <label for="role" class="form-label">Jogosultság</label>
            <select id="role" class="form-select" name="role" @foreach ($roles as $role)>
                <option value="{{$role -> id}}">
                    {{$role -> role}}
                </option>
                @endforeach>
            </select>
        </div>
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary my-3">Mentés</button>
        </div>
    </form>
    
@endsection