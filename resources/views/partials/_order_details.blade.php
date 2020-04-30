<div class="col-md-6">
    <div class="card">
        <header class="card-header">
            <h4 class="card-title mt-2">Your Order</h4>
        </header>
        <div class="card-body">
            @foreach(\Cart::getContent() as $item)
                <div class="d-flex justify-content-between">
                   <var class="price">{{ $item->name }}</var>
                    <var class="price">Quantity: {{ $item->quantity }}</var>
                    <var class="price">{{ config('e-commerce.currency_symbol'). ($item->quantity * $item->price) }}</var>
                </div>
                @if (! $loop->last)
                    <hr>
                @endif
            @endforeach
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                <dl class="dlist-align h4">
                    <dt>Total:</dt>
                    <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ \Cart::getSubTotal() }}</strong></dd>
                </dl>
                <hr>
                <dl class="dlist-align h4">
                    <dt>Tax:</dt>
                    <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ $orderDetails['tax'] }}</strong></dd>
                </dl>
                <hr>
                <dl class="dlist-align h4">
                    <dt>To Pay:</dt>
                    <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ $orderDetails['toPay'] }}</strong></dd>
                </dl>
                <hr>
        </div>
    </div>
</div>
