@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="login-container">
  <main class="login-form">
    <header class="login-form__header">
      <h2 class="login-form__heading">Admin Login</h2>
    </header>
    <form class="login-form__form" action="{{ route('admin.login') }}" method="post">
      @csrf
      <div class="login-form__group">
        <i class="fas fa-envelope"></i>
        <input class="login-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        @if ($errors->has('email'))
          <small class="login-form__error-message">
            ※{{ $errors->first('email') }}
          </small>
        @endif
      </div>
      <div class="login-form__group">
        <i class="fas fa-lock"></i>
        <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
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
