<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rese')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/common.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">Rese</h1>
            <form action="{{ route('menu') }}" method="GET" style="display: inline;">
                <button type="submit" id="menuButton" class="menu-button">
                    <span class="menu-icon"></span>
                    <span class="menu-icon"></span>
                    <span class="menu-icon"></span>
                </button>
            </form>
            <div id="menu" class="menu">
                <ul>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li><a href="{{ route('mypage') }}">Mypage</a></li>
                </ul>
            </div>
            @yield('link')
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
