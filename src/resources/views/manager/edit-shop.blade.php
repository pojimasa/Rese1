@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/edit-shop.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>店舗情報を編集</h1>
        <form action="{{ route('manager.update-shop', $shop->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $shop->name) }}" required>
                @if ($errors->has('name'))
                    <small class="text-danger">
                        ※{{ $errors->first('name') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $shop->location) }}" required>
                @if ($errors->has('location'))
                    <small class="text-danger">
                        ※{{ $errors->first('location') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" name="genre" class="form-control" value="{{ old('genre', $shop->genre) }}" required>
                @if ($errors->has('genre'))
                    <small class="text-danger">
                        ※{{ $errors->first('genre') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="category">Category（詳細）:</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $shop->category) }}" required>
                @if ($errors->has('category'))
                    <small class="text-danger">
                        ※{{ $errors->first('category') }}
                    </small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
@endsection
