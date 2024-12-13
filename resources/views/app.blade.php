<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name') }} </title>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.jpg">
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.key') }}&libraries=places"></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="antialiased">
    @inertia
</body>

</html>
