@component('mail::message')
# Sách tạm thời hết hàng

Xin chào {{ $reservation->user->name }},

Rất tiếc, sách "{{ $reservation->book->title }}" mà bạn đã đặt trước hiện đã hết hàng.

Chi tiết:
- Ngày đặt trước: {{ Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}
- Trạng thái: Đang chờ hàng

Chúng tôi sẽ thông báo cho bạn ngay khi sách có sẵn trở lại.

@component('mail::button', ['url' => 'http://localhost:3000/books/'.$reservation->book_id])
Xem chi tiết sách
@endcomponent

Cảm ơn bạn đã sử dụng dịch vụ của thư viện.

{{ config('app.name') }}
@endcomponent 