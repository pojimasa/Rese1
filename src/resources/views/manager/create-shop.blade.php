@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/create-shop.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>新しい店舗を追加</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manager.store-shop') }}" method="POST" novalidate>
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <small class="text-danger">
                        ※{{ $errors->first('name') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                @if ($errors->has('location'))
                    <small class="text-danger">
                        ※{{ $errors->first('location') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" name="genre" class="form-control" value="{{ old('genre') }}" required>
                @if ($errors->has('genre'))
                    <small class="text-danger">
                        ※{{ $errors->first('genre') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="category">Category（詳細）:</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
                @if ($errors->has('category'))
                    <small class="text-danger">
                        ※{{ $errors->first('category') }}
                    </small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">追加</button>
        </form>
    </div>
@endsection
