@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="register-container">
  <main class="register-form">
    <header class="register-form__header">
      <h2 class="register-form__heading">Admin Registration</h2>
    </header>
    <form class="register-form__form" action="{{ route('admin.register') }}" method="post">
      @csrf
      <div class="register-form__group">
        <div class="register-form__input-container">
          <i class="fas fa-user register-form__icon"></i>
          <input class="register-form__input" type="text" name="name" id="name" placeholder="Username" value="{{ old('name') }}">
        </div>
        @if ($errors->has('name'))
          <small class="register-form__error-message">
            ※{{ $errors->first('name') }}
          </small>
        @endif
      </div>
      <div class="register-form__group">
        <div class="register-form__input-container">
          <i class="fas fa-envelope register-form__icon"></i>
          <input class="register-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        @if ($errors->has('email'))
          <small class="register-form__error-message">
            ※{{ $errors->first('email') }}
          </small>
        @endif
      </div>
      <div class="register-form__group">
        <div class="register-form__input-container">
          <i class="fas fa-lock register-form__icon"></i>
          <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
        </div>
        @if ($errors->has('password'))
          <small class="register-form__error-message">
            ※{{ $errors->first('password') }}
          </small>
        @endif
      </div>
      <div class="btn">
        <button class="register-form__btn" type="submit">登録</button>
      </div>
    </form>
  </main>
</div>
@endsection
