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
    @include('layouts.nav')
    @yield('content')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
