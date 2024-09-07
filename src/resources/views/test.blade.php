<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Test</title>
    <style>
        .reservation-summary {
            display: none;
        }
    </style>
</head>
<body>
    <form id="reservation-form">
        <input type="date" id="reservation-date">
        <select id="reservation-time">
            <option value="09:00">09:00</option>
            <option value="10:00">10:00</option>
            <!-- 他の時間 -->
        </select>
        <select id="number-of-people">
            <option value="1">1人</option>
            <option value="2">2人</option>
            <!-- 他の人数 -->
        </select>
        <div id="reservation-summary">
            <p><span>Date</span> <span id="summary-date"></span></p>
            <p><span>Time</span> <span id="summary-time"></span></p>
            <p><span>Number</span> <span id="summary-number"></span></p>
        </div>
    </form>

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
                console.log('Updating summary...'); // デバッグ用
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
</body>
</html>


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
                <input type="date" name="reservation_date"
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
                <select name="number_of_people" class="form-control" required>
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
            <div class="payment-section">
                <h4>支払い情報</h4>
                <div>
                    <label for="card-number">カード番号</label>
                    <div id="card-number" class="form-control"></div>
                </div>

                <div>
                    <label for="card-expiry">有効期限</label>
                    <div id="card-expiry" class="form-control"></div>
                </div>

                <div>
                    <label for="card-cvc">セキュリティコード</label>
                    <div id="card-cvc" class="form-control"></div>
                </div>
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
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stripe = Stripe('pk_test_51Pg6x5G41mr0BmXRsQQCZIRQxGpyy0ms0t7RxkXKMLL0f8FtalgBP4INwkMBkir8a7x56ySnI647ZjqwCQg7P6IJ00Cqx6kGHu');
            const elements = stripe.elements();

            const cardNumber = elements.create('cardNumber');
            cardNumber.mount('#card-number');
            cardNumber.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardExpiry = elements.create('cardExpiry');
            cardExpiry.mount('#card-expiry');
            cardExpiry.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardCvc = elements.create('cardCvc');
            cardCvc.mount('#card-cvc');
            cardCvc.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const form = document.getElementById('reservation-form');
            const dateInput = document.querySelector('input[name="reservation_date"]');
            const timeInput = document.getElementById('reservation-time');
            const numberOfPeopleInput = document.querySelector('select[name="number_of_people"]');
            const reservationSummary = document.getElementById('reservation-summary');
            const summaryDateSpan = document.getElementById('summary-date');
            const summaryTimeSpan = document.getElementById('summary-time');
            const summaryNumberSpan = document.getElementById('summary-number');

            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);

            dateInput.addEventListener('change', updateSummary);
            timeInput.addEventListener('change', updateSummary);
            numberOfPeopleInput.addEventListener('change', updateSummary);

            function updateSummary() {
                console.log('Updating summary...');
                summaryDateSpan.textContent = dateInput.value || '';
                summaryTimeSpan.textContent = timeInput.value || '';
                summaryNumberSpan.textContent = numberOfPeopleInput.value || '';
                reservationSummary.style.display = 'block';
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(cardNumber).then(function(result) {
                    if (result.error) {
                        var displayError = document.getElementById('card-errors');
                        displayError.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        const formData = new FormData(form);
                        formData.append('stripeToken', result.token.id);

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }).then(function(response) {
                            if (response.ok) {
                                form.submit();
                            } else {
                                return response.json().then(function(json) {
                                    document.getElementById('card-errors').textContent = json.error;
                                });
                            }
                        }).catch(function(error) {
                            document.getElementById('card-errors').textContent = error.message;
                        });
                    }
                });
            });
        });
    </script>
@endsection
