<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- External Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- App's Stylesheet -->
    @vite('resources/sass/app.scss')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Include Navbar from layouts.dashboard -->
    @include('layouts.dashboard')

    <!-- Dynamic Content -->
    @yield('content')

    <!-- Bootstrap JS (for navbar toggle functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Application Scripts -->
    @vite('resources/js/app.js')

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
