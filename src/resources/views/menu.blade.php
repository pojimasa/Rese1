@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('link')

@section('content')

    <h2>Menu Page</h2>
        <p>Welcome to the Menu Page!</p>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
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
@endsection