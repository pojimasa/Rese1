@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/create-manager.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>店舗代表者を作成</h2>

    <form action="{{ route('manager.storeManager') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <small class="text-danger">※{{ $errors->first('name') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <small class="text-danger">※{{ $errors->first('email') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @if ($errors->has('password'))
                <small class="text-danger">※{{ $errors->first('password') }}</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">作成する</button>
    </form>
</div>
@endsection
