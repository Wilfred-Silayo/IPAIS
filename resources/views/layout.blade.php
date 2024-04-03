<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRS | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/solid.css')}}">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h3 class="fw-bold text-black ms-2">CRIME REPORTING SYSTEM</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!---left nav items here-->
                </ul>

                <ul class="navbar-nav me-1 mb-2 mb-lg-0">
                    <!---right nav items here-->
                    @if(Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{route('profile.settings')}}">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link fw-bold text-dark" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Logout
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        @if(!request()->routeIs('login'))
                        <a class="nav-link fw-bold text-dark" href="{{route('login')}}">
                            Login
                        </a>
                        @else
                        <a class="nav-link fw-bold text-dark" href="{{route('welcome.popular')}}">
                            Home
                        </a>
                        @endif
                    </li>
                    @if(Route::has('register'))
                    <li class="nav-item">
                        @if(!request()->routeIs('register'))
                        <a class="nav-link fw-bold text-dark" href="{{route('register')}}">
                            Register
                        </a>
                        @else
                        <a class="nav-link fw-bold text-dark" href="{{route('welcome.popular')}}">
                            Home
                        </a>
                        @endif
                    </li>
                    @endif
                    @endauth
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    @auth
    <!----authenticated user only-->

    @if(auth()->user()->hasRole('admin'))
    @include('admin.sidebar')

    @elseif(auth()->user()->hasRole('officer'))
    @include('officer.sidebar')

    <!-----redirect to reporters(normal users) dashboard-->
    @else
    @include('reporter.sidebar')

    @endif
    <!----unauthenticated user only-->
    @else
    <main class="my-2">
        @yield('content')
    </main>
    @endauth

    <!----modal component-->
    <x-modal title="Confirm Logout" body="Are you sure you want to logout?" routeName="logout" />
</body>

<script src="{{asset('js/bootstrap.js')}}"></script>

</html>