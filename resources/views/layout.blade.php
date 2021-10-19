<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Példa Tejüzem</title>
  </head>
  <body class="bg-info">
    
    @yield('header')
    <div class="container">
        @yield('nav')
      <div class=" bg-light m-auto">
        @yield('content')
      </div>
    </div>
      @if (session()-> has('success'))
            <p class="fixed-top bg-success text-white col-2">{{session()->get('success')}}</p>

          @elseif(session()-> has('fail'))
            <p class="fixed-top bg-danger text-dark col-2">{{session()->get('fail')}}</p>

          @elseif(session()-> has('successEdit'))
            <p class="fixed-top bg-success text-white col-2">{{session()->get('successEdit')}}</p>
          @elseif(session()-> has('successDelete'))
            <p class="fixed-top bg-success text-white col-2">{{session()->get('successDelete')}}</p>
            @elseif(session()-> has('notFound'))
            <p class="fixed-top bg-danger text-white col-2">{{session()->get('notFound')}}</p>
            @elseif(session()-> has('failLogin'))
            <p class="fixed-top bg-danger text-white col-2">{{session()->get('failLogin')}}</p>
            @elseif(session()-> has('couldNotDelete'))
            <p class="fixed-top bg-danger text-white col-2">{{session()->get('couldNotDelete')}}</p>
      @endif   
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html> 