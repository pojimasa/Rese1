@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reservations/done.css') }}">
@endsection

@section('content')
    <div class="done-container">
        <h1>ご予約ありがとうございます</h1>
        <div class="reservation-summary">
            <p>shop: {{ $reservation->shop->name }}</p>
            <p>date: {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</p>
            <p>time: {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</p>
            <p>number: {{ $reservation->number_of_people }}人</p>
        </div>
        <p><a href="{{ route('shop.detail', ['shop_id' => $reservation->shop_id]) }}">戻る</a></p>

    </div>
@endsection
