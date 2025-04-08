@component('mail::message')
# Gói thành viên sắp hết hạn

Xin chào {{ $subscription->user->name }},

Gói thành viên {{ $subscription->package->name }} của bạn sẽ hết hạn vào ngày {{ Carbon\Carbon::parse($subscription->end_date)->format('d/m/Y') }}.

Vui lòng gia hạn gói để tiếp tục sử dụng dịch vụ.

@component('mail::button', ['url' => 'http://localhost:3000/membership'])
Gia hạn ngay
@endcomponent

Cảm ơn bạn đã sử dụng dịch vụ của thư viện chúng tôi.

{{ config('app.name') }}
@endcomponent 