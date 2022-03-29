<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left vh-100">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">

            

            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                @foreach($menuname as $keys => $value)

                @if($value->parent_id == 0 && $value->) 
                <li class="nav-item"><a class="nav-link" href="/customer">{{$value->menu_name}}</a></li>
                @endif
                <li class="nav-item">
                    @if($value->parent_id == 0)
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">{{$value->menu_name}} {{$keys+1}}</a>
                    @if($keys+1 == $value->parent_id)
                    @foreach($menuname as $menu)
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">{{$menu->menu_name}}</a></li>
                    </ul>
                    @endforeach
                    @endif
                    @endif
                </li>
                @endforeach

            </ul>

        </div>
   