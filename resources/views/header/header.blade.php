<!DOCTYPE html>
<html lang="en">
<head>
  <title>My React App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- multiple select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

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
      <li><a href="/multi">C-Language</a></li>
      <li><a href="/add-lag">Add-Language</a></li>
      <li><a href="/learn1?hjj-admin-user-lis=asd||||||sdjfkdjs-userlist">learn1</a></li>
      <li><a href="/learn2">learn2</a></li>
      <li><a href="/learn3">learn3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li style="margin-right: 0px; margin-top: 7px;">
        <input type="search" name="serach" placeholder="Search" id="search" class="form-control search">
      </li>
      <li style="margin-right: 10px; margin-left: 0px; margin-top: 7px;"><button class="btn btn-primary btn-search">Search</button></li>
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

<script type="text/javascript">
  $(document).on("click", ".btn-search", function(event){
    event.preventDefault();
    var search = $('#search').val();
    alert(search);
  });
</script>
</body>
</html>
