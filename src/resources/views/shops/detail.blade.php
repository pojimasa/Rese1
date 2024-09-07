@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shops/detail.css') }}">
@endsection

@section('content')
<section class="container">
    <section class="details">
        <header class="details-header">
            <a href="{{ url()->previous() }}" class="back-button">&lt;</a>
            <h2>{{ $shop->name }}</h2>
        </header>
        <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="shop-image">
        <p class="shop-location">{{ $shop->location }} # {{ $shop->genre }}</p>
        <p class="shop-category">{{ $shop->category }}</p>
    </section>

    <section class="reservation">
        <h2>予約</h2>
        <form id="reservation-form" action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="form-group">
                <input type="date" name="reservation_date" id="reservation-date"
                       value="{{ old('reservation_date') }}"
                       class="form-control"
                       min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                @error('reservation_date')
                    <div class="text-danger">※{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <select name="reservation_time" id="reservation-time" class="form-control" required>
                    @for ($i = 0; $i < 24; $i++)
                        @for ($j = 0; $j < 2; $j++)
                            @php
                                $time = sprintf('%02d:%02d', $i, $j * 30);
                            @endphp
                            <option value="{{ $time }}" {{ old('reservation_time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                        @endfor
                    @endfor
                </select>
                @error('reservation_time')
                    <div class="text-danger">※{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <select name="number_of_people" id="number-of-people" class="form-control" required>
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>{{ $i }}人</option>
                    @endfor
                </select>
                @error('number_of_people')
                    <div class="text-danger">※{{ $message }}</div>
                @enderror
            </div>

            <div id="reservation-summary" class="reservation-summary">
                <p><span>Shop</span> <span id="shop-name">{{ $shop->name }}</span></p>
                <p><span>Date</span> <span id="summary-date"></span></p>
                <p><span>Time</span> <span id="summary-time"></span></p>
                <p><span>Number</span> <span id="summary-number"></span>人</p>
            </div>

            <div id="card-errors" class="text-danger"></div>
            <button type="submit" class="mt-3 btn btn-primary">予約する</button>
        </form>
    </section>

    <section class="rating-form">
        <h3>評価とコメント</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('reservation_error'))
            <div class="alert alert-danger">
                {{ session('reservation_error') }}
            </div>
        @endif

        <form action="{{ route('ratings.store') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="shop_id" value="{{ old('shop_id', $shop->id) }}">

            <div class="form-group">
                <label for="rating">評価:</label>
                <select name="rating" id="rating" class="form-control">
                    <option value="">選択してください</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - 大変満足</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - 満足</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - 普通</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - やや不満</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - 不満足</option>
                </select>
                @if ($errors->has('rating'))
                    <small class="text-danger">※{{ $errors->first('rating') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">コメント:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4">{{ old('comment') }}</textarea>
                @if ($errors->has('comment'))
                    <small class="text-danger">※{{ $errors->first('comment') }}</small>
                @endif
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">評価を投稿する</button>
            </div>
        </form>
    </section>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('reservation-date');
        const timeInput = document.getElementById('reservation-time');
        const numberOfPeopleInput = document.getElementById('number-of-people');
        const reservationSummary = document.getElementById('reservation-summary');
        const summaryDateSpan = document.getElementById('summary-date');
        const summaryTimeSpan = document.getElementById('summary-time');
        const summaryNumberSpan = document.getElementById('summary-number');

        function updateSummary() {
            summaryDateSpan.textContent = dateInput.value || '未選択';
            summaryTimeSpan.textContent = timeInput.value || '未選択';
            summaryNumberSpan.textContent = numberOfPeopleInput.value || '未選択';
            reservationSummary.style.display = 'block';
        }

        dateInput.addEventListener('change', updateSummary);
        timeInput.addEventListener('change', updateSummary);
        numberOfPeopleInput.addEventListener('change', updateSummary);
    });
</script>
@endsection
