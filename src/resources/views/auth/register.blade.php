@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="register-container">
  <main class="register-form">
    <div class="register-form__header">
      <h2 class="register-form__heading">Registration</h2>
    </div>
    <div class="register-form__inner">
      <form class="register-form__form" action="{{ route('register') }}" method="post">
        @csrf
        <div class="register-form__group">
          <i class="fas fa-user"></i>
          <input class="register-form__input" type="text" name="name" id="name" placeholder="Username" value="{{ old('name') }}">
          @if ($errors->has('name'))
            <small class="text-danger">
              ※{{ $errors->first('name') }}
            </small>
          @endif
        </div>
        <div class="register-form__group">
          <i class="fas fa-envelope"></i>
          <input class="register-form__input" type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
          @if ($errors->has('email'))
            <small class="text-danger">
              ※{{ $errors->first('email') }}
            </small>
          @endif
        </div>
        <div class="register-form__group">
          <i class="fas fa-lock"></i>
          <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
          @if ($errors->has('password'))
            <small class="text-danger">
              ※{{ $errors->first('password') }}
            </small>
          @endif
        </div>
        <div class="btn">
          <button class="register-form__btn" type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</div>
@endsection
