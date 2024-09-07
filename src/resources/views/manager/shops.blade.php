@extends('layouts.manager')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager/shops.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>店舗情報</h1>

        @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('manager.create-shop') }}" class="btn btn-primary">店舗を追加</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>画像</th>
                    <th>場所</th>
                    <th>ジャンル</th>
                    <th>カテゴリ（詳細）</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $shop)
                    <tr>
                        <td>{{ $shop->id }}</td>
                        <td>{{ $shop->name }}</td>
                        <td>
                            @if($shop->image)
                                <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                            @else
                                @if($shop->genre === 'ラーメン')
                                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @elseif($shop->genre === '寿司')
                                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @elseif($shop->genre === 'イタリアン')
                                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @elseif($shop->genre === '居酒屋')
                                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @elseif($shop->genre === '焼肉')
                                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" alt="{{ $shop->name }}" style="width: 100px; height: auto;">
                                @endif
                            @endif
                        </td>
                        <td>{{ $shop->location }}</td>
                        <td>{{ $shop->genre }}</td>
                        <td>{{ $shop->category }}</td>
                        <td>
                            <a href="{{ route('manager.edit-shop', $shop->id) }}" class="btn btn-primary">編集</a>
                            <form action="{{ route('manager.save-image', $shop->id) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                                @csrf
                                <input type="file" name="image" accept="image/*" required>
                                <button type="submit" class="btn btn-secondary">画像を保存</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
