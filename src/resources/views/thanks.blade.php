@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks-container">
        <h1>会員登録ありがとうございます</h1>
            <div class="btn">
                <a class="thanks-form__btn" href="{{ route('login') }}">ログインする</a>
            </div>
    </div>
@endsection
