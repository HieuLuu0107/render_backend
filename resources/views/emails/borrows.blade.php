@component('mail::message')
# Mượn sách thành công

Xin chào {{ $borrow->user->name }},

Bạn đã mượn thành công sách "{{ $borrow->book->title }}".

Chi tiết mượn sách:
- Ngày mượn: {{ Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') }}
- Ngày hẹn trả: {{ Carbon\Carbon::parse($borrow->due_date)->format('d/m/Y') }}

@component('mail::button', ['url' => 'http://localhost:3000/borrows'])
Xem sách đã mượn
@endcomponent

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 