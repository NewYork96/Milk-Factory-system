@extends('nav')
  
@section('content')
<table class="table">
  <tr>
    <th>Megnevezes</th>
    <th>Kiszereles</th>
    <th>Mennyiseg</th>
    <th>Szavatossagi_ido</th>
    <th>Tej</th>
    <th>Adalekanyag</th>
    <th>Pozicio</th>
  </tr>
  @foreach ($query as $product)
      <tr>
        <td>{{$product ->Megnevezes}}</td>
        <td>{{$product ->Kiszereles}}</td>
        <td>{{$product ->Mennyiseg}}</td>
        <td>{{$product ->Szavatossagi_ido}}</td>
        <td>{{$product ->Tej}}</td>
        <td> {{$product ->Adalekanyag}}</td>
        <td>{{$product ->Pozicio}}</td>
        <td>
          <a href=""><button type="button" class="btn btn-secondary">Secondary</button></a>
        </td> 
      </tr>
    @endforeach 
@endsection

  
