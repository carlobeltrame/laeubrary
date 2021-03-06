<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div id="app" class="min-h-screen bg-green-50 text-gray-900">
            {{ $slot }}
        </div>
        <div id="laravel-data" data-laravel="{{ json_encode([
    'oldInput' => (object) Session::getOldInput(),
    'errors' => (object) $errors->get('*'),
    'routes' => collect(Route::getRoutes())->mapWithKeys(function (\Illuminate\Routing\Route $route) { return [$route->getName() => [ 'uri' => '/'.$route->uri(), 'method' => head($route->methods())]]; }),
    'user' => Auth::user() ?? new stdClass(),
    'errors' => $errors->toArray(),
    'status' => session('status'),
    'csrf' => csrf_token(),
]) }}"></div>
    </body>
</html>
