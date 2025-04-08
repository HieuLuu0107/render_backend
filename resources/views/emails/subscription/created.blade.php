@component('mail::message')
# Đăng ký gói thành viên thành công

Xin chào {{ $subscription->user->name }},

Cảm ơn bạn đã đăng ký gói thành viên {{ $subscription->package->name }}.

Chi tiết gói:
- Tên gói: {{ $subscription->package->name }}
- Ngày bắt đầu: {{ Carbon\Carbon::parse($subscription->start_date)->format('d/m/Y') }}
- Ngày kết thúc: {{ Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y') }}

@component('mail::button', ['url' => 'http://localhost:3000/membership'])
Xem chi tiết gói thành viên
@endcomponent

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 