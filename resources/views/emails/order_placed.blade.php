@component('mail::message')
# Order Received

**Order ID** {{ $order->id }} <br>
**Order Email** {{ $order->billing_email }} <br>
**Order Billing Name** {{ $order->billing_name }} <br>
**Order Total** {{ config('e-commerce.currency_symbol') }} {{ round($order->billing_total) }} <br>

You can get further details about your order by visiting our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go To Website
@endcomponent


Thank you for choosing us!
{{ config('app.name') }}.
@endcomponent
