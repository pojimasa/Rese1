@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="login-container">
    @if (session('result'))
    <div class="alert alert-danger">
        {{ session('result') }}
    </div>
    @endif
  <main class="login-form">
    <header class="login-form__header">
      <h2 class="login-form__heading">Login</h2>
    </header>
    <form class="login-form__form" action="{{ route('login') }}" method="post">
      @csrf
      <div class="login-form__group">
        <div class="login-form__input-container">
          <i class="fas fa-envelope login-form__icon"></i>
          <input class="login-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        @if ($errors->has('email'))
          <small class="login-form__error-message">
            ※{{ $errors->first('email') }}
          </small>
        @endif
      </div>
      <div class="login-form__group">
        <div class="login-form__input-container">
          <i class="fas fa-lock login-form__icon"></i>
          <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
        </div>
        @if ($errors->has('password'))
          <small class="login-form__error-message">
            ※{{ $errors->first('password') }}
          </small>
        @endif
      </div>
      <div class="btn">
        <button class="login-form__btn" type="submit">ログイン</button>
      </div>
    </form>
  </main>
</div>
@endsection
