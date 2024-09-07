@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection

@section('content')
    @if (Auth::check())
        <div class="mypage-container">
            <h2 class="user-name">{{ Auth::user()->name }}さん</h2>

            <section class="main-content">
                <section class="reservation-status">
                    <h3>予約状況</h3>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @forelse ($reservations as $reservation)
                        <article class="reservation-card">
                            <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">×</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    return confirm('本当に取り消しますか？');
                                }
                            </script>

                            <p><i class="fas fa-clock"></i> 予約{{ $loop->iteration }}</p>
                            <p>Shop {{ $reservation->shop->name }}</p>
                            <p>Date {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</p>
                            <p>Time {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</p>
                            <p>Number {{ $reservation->number_of_people }}</p>
                            
                            <button type="button" class="edit-button" id="edit-button-{{ $reservation->id }}" onclick="toggleEditForm({{ $reservation->id }})">更新する</button>

                            <form id="edit-form-{{ $reservation->id }}" action="{{ route('reservation.update', $reservation->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="reservation_date">新しい予約日:</label>
                                    <input type="date" name="reservation_date" value="{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}" class="form-control" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="reservation_time">新しい予約時間:</label>
                                    <select name="reservation_time" class="form-control">
                                        @for ($i = 0; $i < 24; $i++)
                                            @for ($j = 0; $j < 2; $j++)
                                                @php
                                                    $time = sprintf('%02d:%02d', $i, $j * 30);
                                                @endphp
                                                <option value="{{ $time }}" {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') == $time ? 'selected' : '' }}>{{ $time }}</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="number_of_people">新しい予約人数:</label>
                                    <input type="number" name="number_of_people" value="{{ $reservation->number_of_people }}" min="1" max="4" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="update-button">保存する</button>
                                </div>
                            </form>
                        </article>
                    @empty
                        <p>予約はありません。</p>
                    @endforelse
                </section>

                <section class="favorites-section">
                    <h3>お気に入り店舗</h3>
                    <div class="shop-list">
                        @forelse ($favorites as $favorite)
                            <article class="shop-item">
                                <img src="{{ $favorite->shop->image }}" alt="{{ $favorite->shop->name }}">
                                <div class="shop-info">
                                    <h2>{{ $favorite->shop->name }}</h2>
                                    <p>#{{ $favorite->shop->location }} #{{ $favorite->shop->genre }}</p>
                                    <div class="shop-actions">
                                        <a href="{{ route('shop.detail', $favorite->shop->id) }}" class="shop-info-button">詳しく見る</a>
                                        <div class="like-button">
                                            <form action="{{ route('shop.unlike', $favorite->shop->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-like">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p>お気に入り店舗はありません。</p>
                        @endforelse
                    </div>
                </section>
            </section>
        </div>
    @endif

    <script>
        function toggleEditForm(reservationId) {
            const form = document.getElementById('edit-form-' + reservationId);
            const button = document.getElementById('edit-button-' + reservationId);
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                button.innerText = '更新を止める';
            } else {
                form.style.display = 'none';
                button.innerText = '更新する';
            }
        }
    </script>
@endsection
