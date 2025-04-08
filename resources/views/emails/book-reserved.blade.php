<!DOCTYPE html>
<html>
<head>
    <title>Đặt trước sách thành công</title>
</head>
<body>
    @component('mail::message')
    # Đặt trước sách thành công

    Xin chào {{ $reservation->user->name }},

    Bạn đã đặt trước thành công sách "{{ $reservation->book->title }}".

    Chi tiết:
    - Ngày đặt: {{ Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}
    - Trạng thái: Đang chờ

    @component('mail::button', ['url' => 'http://localhost:3000/borrows'])
    Xem sách đã đặt trước
    @endcomponent

    Trân trọng,<br>
    {{ config('app.name') }}
    @endcomponent
</body>
</html> 