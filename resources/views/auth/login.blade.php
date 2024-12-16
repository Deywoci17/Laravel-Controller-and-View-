@php
    $currentRouteName = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/sass/app.scss')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                MyApp
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Auth Links (Login, Register, Reset Password) -->
            @auth
                <div class="dropdown mx-auto my-auto">
                    <a class="btn dropdown-toggle btn-outline-light" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi-person-circle me-1"></i> Administration
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>
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
            @else
                <ul class="navbar-nav flex-row ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                            class="nav-link @if ($currentRouteName == 'login') active @endif">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                            class="nav-link @if ($currentRouteName == 'register') active @endif">Register</a>
                    </li>
                </ul>
            @endauth
        </div>
    </nav>

    <div style="display: flex; justify-content: center; align-items: center;margin-top: 100px;">
        <div
            style="height: 60%; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
            <div>
                <img src="https://cdn.freebiesupply.com/logos/large/2x/mcdonalds-15-logo-png-transparent.png" width="150"
                    alt="Logo" style="margin-bottom: 20px;">
            </div>
            <h3 style="margin-bottom: 20px; color: #333;">Employee Data Master</h3>


            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div style="margin-bottom: 15px;">
                    <input type="email" name="email" placeholder="Enter Your Email" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <input type="password" name="password" placeholder="Enter Your Password" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <!-- Forgot Password Link Above Login Form -->
                <div style="margin-bottom: 15px; text-align: left;">
                    <a href="{{ route('password.request') }}"
                        class="text-decoration-none text-primary @if ($currentRouteName == 'password.request') active @endif">Forgot
                        Password?</a>
                </div>

                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 10px; background-color: #ff6600; border: none; border-radius: 5px; color: white; font-weight: bold;">
                    Log In
                </button>
            </form>
        </div>
    </div>

</body>

</html>
