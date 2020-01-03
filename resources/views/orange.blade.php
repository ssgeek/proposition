<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Générateur de proposition commerciale automatique</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom:100px;">
    <div class="container">
      <a class="navbar-brand" href="{{ URL::action('HomeController@index') }}">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" href="{{ URL::action('PropositionController@index') }}">Proposition</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::action('UserController@index') }}">Utilisateurs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::action('TarifController@index') }}">Tarifs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::action('SiteController@index') }}">Sites Orange</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>




  <div class="container"style="margin-top:150px;>
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>