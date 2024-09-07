@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<main class="container">
    <section class="search-form-wrapper">
        <form action="{{ route('shop.search') }}" method="GET" class="search-form" id="search-form">
            <select name="area" onchange="document.getElementById('search-form').submit();">
                <option value="">All area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->location }}" {{ request('area') == $area->location ? 'selected' : '' }}>
                        {{ $area->location }}
                    </option>
                @endforeach
            </select>

            <select name="genre" onchange="document.getElementById('search-form').submit();">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->genre }}" {{ request('genre') == $genre->genre ? 'selected' : '' }}>
                        {{ $genre->genre }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="name" placeholder="🔍 Search..." id="search-input" value="{{ request('name') }}">
        </form>
    </section>

    <section class="shop-list">
        @foreach($shops as $shop)
        <article class="shop-item">
            <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
            <div class="shop-info">
                <h2>{{ $shop->name }}</h2>
                <p>#{{ $shop->location }} #{{ $shop->genre }}</p>
                <div class="shop-actions">
                    <a href="{{ route('shop.detail', $shop->id) }}" class="shop-info-button">詳しく見る</a>
                    <div class="like-button">
                        @if($shop->isLikedByAuthUser())
                            <form action="{{ route('shop.unlike', $shop->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-like liked">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('shop.like', $shop->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-like">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </section>
</main>
@endsection

@section('scripts')
<script>
    let timer;
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');

    searchInput.addEventListener('keyup', () => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            searchForm.submit();
        }, 500);
    });
</script>
@endsection
