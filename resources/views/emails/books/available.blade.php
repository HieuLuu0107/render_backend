@component('mail::message')
# Sách đã có sẵn

Xin chào {{ $reservation->user->name }},

Sách "{{ $reservation->book->title }}" mà bạn đã đặt trước hiện đã có sẵn.

Chi tiết đặt trước:
- Ngày đặt: {{ Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}
- Trạng thái: Có sẵn

@component('mail::button', ['url' => 'http://localhost:3000/books/'.$reservation->book_id])
Xem chi tiết sách
@endcomponent

Vui lòng đến mượn sách trong vòng 24 giờ. Sau thời gian này, đặt trước của bạn sẽ bị hủy.

Cảm ơn bạn đã sử dụng dịch vụ của thư viện.

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 