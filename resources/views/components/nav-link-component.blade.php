<li class="nav-item">
    <a href="{{route($route)}}"
        class="nav-link d-block  align-middle ps-2 pe-4 {{request()->routeIs($route)? 'bg-white': ''}} ">
        <i class="{{$icon}} {{request()->routeIs($route)? 'text-dark': 'text-white'}} "></i>
        <span
            class="ms-1 d-none d-sm-inline {{request()->routeIs($route)? 'text-dark': 'text-white'}}">{{$text}}
            @if($text ==='Notifications')
            <span class='badge bg-warning ps-1'>0</span>
            @endif
        
        </span>
    </a>
</li>