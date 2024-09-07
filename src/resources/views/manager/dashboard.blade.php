@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/dashboard.css') }}">
@endsection


@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>管理人ダッシュボード</h1>
        <ul>
            <li><a href="{{ route('manager.createManager') }}">店舗代表者を追加</a></li>
            <li><a href="{{ route('notifications.create') }}">お知らせメール</a></li>
        </ul>
    </div>
@endsection

