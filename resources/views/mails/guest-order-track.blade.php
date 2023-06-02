@component('mail::message')
# {{ $title }}
Order number : #{{ $order->order_no }}
@component('mail::button', ['url' => route('website.track.order.detail', ['order' => $order->order_no])])
Track Order
@endcomponent
{{ __('thanks') }},<br>
{{ config('app.name') }}
@endcomponent
