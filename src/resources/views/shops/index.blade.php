@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shops/index.css') }}">
@endsection

@section('link')

@section('content')

<h1>飲食店一覧</h1>
    <ul>
        @foreach ($shops as $shop)
            <li>
                <a href="{{ url('/detail', $shop->id) }}">{{ $shop->name }}</a>
            </li>
        @endforeach
    </ul>

@endsection