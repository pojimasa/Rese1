@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shops/index.css') }}">
@endsection

@section('link')

@section('content')
    <div class="container">
        <header>
            <h1>Rese</h1>
        </header>
        <div class="content">
            <div class="shop-info">
                <a href="{{ url('/') }}"></a>
                <h2>{{ $shop->name }}</h2>
                <img src="{{ asset('images/shop_image.jpg') }}" alt="{{ $shop->name }}">
                <p>{{ $shop->description }}</p>
            </div>
            <div class="reservation">
                <h3>予約</h3>
                <form action="{{ url('/reservation') }}" method="POST">
                    @csrf
                    <input type="date" name="date" required>
                    <input type="time" name="time" required>
                    <select name="number" required>
                        <option value="1">1人</option>
                        <option value="2">2人</option>
                        <option value="3">3人</option>
                        <option value="4">4人</option>
                    </select>
                    <div class="reservation-summary">
                        <p>Shop: {{ $shop->name }}</p>
                        <p>Date: <span id="selected-date"></span></p>
                        <p>Time: <span id="selected-time"></span></p>
                        <p>Number: <span id="selected-number"></span></p>
                    </div>
                    <button type="submit">予約する</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>

@endsection