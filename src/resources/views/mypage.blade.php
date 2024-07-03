@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('link')

@section('content')
<div>
    <h2>予約状況</h2>
    @if (Auth::check())
            <h2>{{ Auth::user()->name }}さん</h2>
            <p>お気に入り店舗</p>
        @endif
</div>
@endsection
