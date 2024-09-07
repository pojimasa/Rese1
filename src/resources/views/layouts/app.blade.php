<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rese')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('css')
</head>
<body>
<div class="app">
    <header class="header">
        <div class="menu-container">
            <button id="menuButton" class="menu-button">
                <span class="menu-icon menu-icon--medium"></span>
                <span class="menu-icon menu-icon--long"></span>
                <span class="menu-icon menu-icon--short"></span>
            </button>
            <h1 class="header__heading">Rese</h1>
        </div>
        <nav id="menu" class="menu">
            <div class="close-menu" id="closeMenu">
                <span>&times;</span>
            </div>
            <ul>
                @if(request()->is('login') || request()->is('register'))
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </li>
                    <li><a href="{{ route('mypage') }}">Mypage</a></li>
                @endif
            </ul>
        </nav>
        @yield('link')
    </header>
    <main class="content">
        @yield('content')
    </main>
    <div id="loading" class="loading" style="display: none;">
        <p>Loading...</p>
    </div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            document.getElementById('menu').classList.add('show');
            document.getElementById('menu').classList.remove('hide');
            document.getElementById('loading').style.display = 'none';
        });

        document.getElementById('closeMenu').addEventListener('click', function() {
            document.getElementById('menu').classList.remove('show');
            document.getElementById('menu').classList.add('hide');
            document.getElementById('loading').style.display = 'none';
        });

        document.querySelectorAll('.menu ul li a').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                document.getElementById('menu').classList.remove('show');
                document.getElementById('menu').classList.add('hide');
                document.getElementById('loading').style.display = 'block';

                setTimeout(function() {
                    window.location.href = href;
                }, 300);
            });
        });
    </script>
</body>
</html>
