<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約確認</title>
</head>
<body>
    <h1>予約確認</h1>
    <p>{{ $reservation->user->name }} 様</p>
    <p>以下の内容で予約が完了しました</p>
    <p>店舗名: {{ $reservation->shop->name }}</p>
    <p>予約日時: {{ $reservation->reservation_date }}</p>
    <p>予約人数: {{ $reservation->number_of_people }}人</p>
    <p>以下のQRコードを店舗で提示してください</p>
    <img src="{{ $qrCodeUrl }}" alt="QRコード">
    <p>どうぞよろしくお願いします。</p>
</body>
</html>