@php
    $currentRouteName = Route::currentRouteName();
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    {{-- @extends('layouts.nav') --}}

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand mb-0 h1"><i class="bi-hexagon-fill me-2"></i> Data
                    Master</a>

                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <hr class="d-md-none text-white-50">

                    <ul class="navbar-nav flex-row flex-wrap">
                        <li class="nav-item col-2 col-md-auto"><a href="{{ route('home') }}"
                                class="nav-link @if ($currentRouteName == 'home') active @endif">Home</a></li>
                        <li class="nav-item col-2 col-md-auto"><a href="{{ route('employees.index') }}"
                                class="nav-link @if ($currentRouteName == 'employees.index') active @endif">Employee</a></li>
                    </ul>

                    <hr class="d-md-none text-white-50">

                    {{-- <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i
                        class="bi-person-circle me-1"></i> My Profile</a> --}}
                </div>
                <div class="dropdown mx-auto my-auto">
                    <a class="btn dropdown-toggle btn-outline-light" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-person-circle me-1"></i>
                        Administration
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">My profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
