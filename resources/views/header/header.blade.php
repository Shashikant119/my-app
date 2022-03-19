<!DOCTYPE html>
<html lang="en">
<head>
  <title>My React App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    .logout{margin-top: 10px;}
    .logout a:hover {color: blue;text-decoration: none;font-size: 15px;}
    .logout a{margin-right: 22px;color: #fff;}
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MyReactApp</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Dashboard</a></li>
      <li><a href="{{route('users-list')}}">Users</a></li>
      <li><a href="/my-app">My-App</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if(Auth::check())
      <li><form method="POST" action="{{ route('logout') }}" class="logout">
          @csrf
          <a :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              {{ __('Log Out') }}
          </a>
      </form></li>
      @endif
    </ul>
  </div>
</nav>  
@yield('content')
</body>
</html>
