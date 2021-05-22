<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div id="app" class="min-h-screen bg-gray-100">
            @php "@include('layouts.navigation')" @endphp
            <top-navigation></top-navigation>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <div id="laravel-data" data-laravel="{{ json_encode([
    'oldInput' => (object) Session::getOldInput(),
    'errors' => (object) $errors->get('*'),
    'routes' => collect(Route::getRoutes())->mapWithKeys(function (\Illuminate\Routing\Route $route) { return [$route->getName() => [ 'uri' => '/'.$route->uri(), 'method' => head($route->methods())]]; }),
    'user' => Auth::user(),
    'csrf' => csrf_token(),
]) }}"></div>
    </body>
</html>
