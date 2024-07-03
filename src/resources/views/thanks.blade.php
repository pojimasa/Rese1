<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
  @yield('css')
</head>

<body>
    <div class="thanks-container">
        <h1>ご登録ありがとうございます！</h1>
            <div class="btn">
                <a class="thanks-form__btn" href="{{ route('login') }}">ログインする</a>
            </div>
    </div>
</body>

</html>
