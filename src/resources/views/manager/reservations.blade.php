@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/reservations.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>予約一覧</h1>

        @if($reservations->isEmpty())
            <p>予約がありません。</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th class="column-id">ID</th>
                        <th class="column-user-id">ユーザーID</th>
                        <th class="column-shop-id">店舗ID</th>
                        <th class="column-date">予約日</th>
                        <th class="column-people">人数</th>
                        <th class="column-created">作成日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td class="column-id">{{ $reservation->id }}</td>
                            <td class="column-user-id">{{ $reservation->user_id }}</td>
                            <td class="column-shop-id">{{ $reservation->shop_id }}</td>
                            <td class="column-date">{{ $reservation->reservation_date }}</td>
                            <td class="column-people">{{ $reservation->number_of_people }}</td>
                            <td class="column-created">{{ $reservation->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
