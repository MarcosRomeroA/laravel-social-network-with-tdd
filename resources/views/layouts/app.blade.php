<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-social">

        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">SocialApp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto"></ul>

                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <div class="nav-link"><a href="{{route('login')}}">Login</a></div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a onclick="document.getElementById('logout').submit()" class="dropdown-item" href="#">Cerrar sesion</a>
                            </div>
                        </li>
                        <form id="logout" action="{{route('logout')}}" method="POST">@csrf</form>
                    @endguest
                </ul>
            </div>
        </div>

    </nav>
    <main id="app" class="py-4">
        @yield('content')
    </main>

    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>
</html>
