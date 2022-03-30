<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left vh-100">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">

            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">

                @foreach($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ $menu->menu_name }}
                        @if(count($menu->childs))
                            @include('menu.manageChild',['childs' => $menu->childs])
                        @endif</a>
                    </li>
                @endforeach
           
               
              
                <li class="nav-item">
                 
                    <a class="nav-link" href="##" data-toggle="collapse" data-target="#submenu1">DROPDOWN MENU
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">submneu</a></li>
                    </ul>
                  
                </li>
              
            </ul>

        </div>
   