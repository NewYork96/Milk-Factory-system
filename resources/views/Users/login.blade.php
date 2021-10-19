@extends('header')

@section('content')
<div class="position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-md-center">
        <div class="col-12">
        <div class="card bg-light text-dark">
            <h5 class="card-header bg-success text-white">Login</h5>
            
            <form action="/store" method="post">
                @csrf
                @method('POST')
                <div class="row justify-content-md-center">
                    <div class="mb-3 col-8">
                        <label for="email" class="form-label">E-mail cím</label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{old('email')}}">
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="mb-3 col-8">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control" id=password" name="password"  value="">
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="mb-3 col-8">
                            <button type="submit" class="btn btn-primary">Belépés</button>
                        </div>
                    </div>    
                </div>
                </form>
          </div>
        </div>
    </div>
</div>
@endsection