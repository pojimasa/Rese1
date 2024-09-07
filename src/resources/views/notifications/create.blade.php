@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/notifications/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>お知らせを送信</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notifications.store') }}" method="POST" id="notification-form">
        @csrf
        <div class="form-group">
            <label for="message">お知らせ内容:</label>
            <textarea name="message" id="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
        </div>

        <div class="form-group">
            <label for="user_ids">特定のユーザーを選択 (全ユーザーに送信する場合は選択不要):</label>
            <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                <option value="" disabled>選択しない</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ in_array($user->id, old('user_ids', [])) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="button" class="btn btn-primary" onclick="submitNotification('specific')">特定のユーザーに送信</button>
        <button type="button" class="btn btn-secondary" onclick="submitNotification('all')">全ユーザーに送信</button>
    </form>

    <script>
        function submitNotification(type) {
            let form = document.getElementById('notification-form');
            let selectElement = document.getElementById('user_ids');

            if (type === 'all') {
                selectElement.value = [];
            }

            form.submit();
        }
    </script>
</div>
@endsection
