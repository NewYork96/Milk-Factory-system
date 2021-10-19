@extends('nav')

@section('content')

    <form action="{{route('users.update', $user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3 mx-auto col-6">
            <label for="name" class="form-label">Név</label>
            <input type="text" class="form-control" id="name" name="name"  value="{{$user -> name}}">
        </div>
        @error('user')
        <div class="mb-2 text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="email" class="form-label">E-mail cím</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user -> email}}">
        </div>
        @error('email')
        <div class="text-danger fs-6 mx-auto col-6">{{$message}}</div>
    @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="phone_number" class="form-label">Telefonszám</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"  value="{{$user -> phone_number}}">
        </div>
        @error('phone_number')
            <div class=" mb-2  text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="password" class="form-label">Jelszó módosítása</label>
            <input type="password" class="form-control" id="password" name="password"  value="">
        </div>
        @error('password')
            <div class=" mb-2  text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="password_confirmation" class="form-label">Jelszó újra</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  value="">
        </div>
        @error('password')
            <div class=" mb-2  text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        <div class="mb-3 mx-auto col-6">
            <label for="id_card_number" class="form-label">Szemlyi igazolvány szám</label>
            <input type="text" class="form-control" id="id_card_number" name="id_card_number"  value="{{$user -> id_card_number}}">
        </div>
        @error('id_card_number')
            <div class=" mb-2  text-danger fs-6 mx-auto col-6">{{$message}}</div>
        @enderror
        @can('updateRole')
        <div class="mx-auto col-6 mb-3">
            <label for="role" class="form-label">Jogosultság</label>
            <select id="role" class="form-select" name="role" @foreach ($roles as $role)>
                <option value="{{$role -> id}}" @if ($user -> role_id == $role -> id)
                    {{'selected'}}
                @else
                    {{''}}
                @endif>
                    {{$role -> role}}
                </option>
                @endforeach
            </select>
        </div>
        @endcan
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary mb-3">Mentés</button>
        </div>
    </form>
    
@endsection