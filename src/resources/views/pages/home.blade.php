@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="shop-list">
        @foreach($shops as $shop)
        <div class="shop-item">
            <img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}">
            <div class="shop-info">
                <h2>{{ $shop['name'] }}</h2>
                <p>#{{ $shop['location'] }}</p>
                <p>#{{ $shop['category'] }}</p>
                <button>詳しくみる</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
