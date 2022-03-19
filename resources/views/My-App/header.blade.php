<style type="text/css">
    input.form-control {
    margin-left: -1px;
}
</style>
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary mb-3">
    <div class="flex-row d-flex">
        <button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{url('/')}}" title="Free Bootstrap 4 Admin Template">My-App</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}/my-app">Home <span class="sr-only">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/blog">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/post/index">Post</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @php //  echo $cturl; @endphp
            @if(@$cturl == "index")
            <li class="nav-item">
                <a class="nav-link" href="#myAlert" data-toggle="modal">Add-New-Post</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="#myAlert" data-toggle="modal">Register</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="" data-target="#myModal" data-toggle="modal">Login</a>
            </li>
        </ul>
    </div>
</nav>