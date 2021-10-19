@extends('header')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light text-white bg-success">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="/" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Raktár
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('viewAny', App\Models\Provider::class)
                            <li><a class="dropdown-item" href="{{route('providers.index')}}">Beszállítók</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="/">Készáru Készlet</a></li>
                        @can('viewAny', App\Models\AdditiveStore::class)
                            <li><a class="dropdown-item" href="{{route('additiveStores.index')}}">Adalékanyag Készlet</a></li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Termelés
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('viewAny', App\Models\Additive::class)
                            <li><a class="dropdown-item" href="{{route('additives.index')}}">Adalékanyagok</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{route('products.index')}}">Tremékek</a></li>
                        @can('viewAny', App\Models\Milkstore::class)
                           <li><a class="dropdown-item" href="{{route('milkStore.index')}}">Tejkészlet</a></li>
                        @endcan
                        @can('viewAny', App\Models\ProductionOrder::class)
                            <li><a class="dropdown-item" href="{{route('productionOrders.index')}}">Termelés tervezet</a></li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="{{route('users.index')}}" id="navbar" role="button" aria-expanded="false">
                    Felhasználók
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-2">
            <span>Belépve: {{Auth::user() -> name}}</span>
        </div>
        <div class="col-1">
            <form action="/destroy" method="post">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-warning">Kilépés</button>
            </form>
        </div>
    </nav> 
@endsection