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
                    <var class="price">
                        {{ config('e-commerce.currency_symbol'). number_format(($item->quantity * $item->price), 2) }}
                    </var>
                </div>
                @if (! $loop->last)
                    <hr>
                @endif
            @endforeach
                <hr style="height:1px;border:none;color:#333;background-color:#333;">
                <dl class="dlist-align h4">
                    <dt>Total:</dt>
                    <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ number_format(\Cart::getSubTotal(), 2) }}</strong></dd>
                </dl>
                <hr>
                @if (session()->has('coupon'))
                    <dl class="dlist-align h4">
                        <dt class="d-flex w-75">Discount ({{ session()->get('coupon')['name'] }}):
                            <form action="/coupon" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </dt>
                        <dd class="text-right">
                            <strong>
                                -{{ config('e-commerce.currency_symbol') }}{{ number_format(session()->get('coupon')['discount'], 2) }}
                            </strong>
                        </dd>
                    </dl>
                    <hr>
                    <dl class="dlist-align h4">
                        <dt>New Total:</dt>
                        <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ number_format(\Cart::getSubTotal() - session()->get('coupon')['discount'], 2) }}</strong></dd>
                    </dl>
                    <hr>
                @endif
                <dl class="dlist-align h4">
                    <dt>Tax:</dt>
                    <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ number_format($orderDetails['tax'], 2) }}</strong></dd>
                </dl>
                <hr>
                <dl class="dlist-align h4">
                    <dt>To Pay:</dt>
                    <dd class="text-right">
                        <strong>
                            {{ config('e-commerce.currency_symbol') }}{{ number_format($orderDetails['toPay'], 2) }}
                        </strong>
                    </dd>
                </dl>
                <hr>
                @if (! session()->has('coupon'))
                    <dl class="dlist-align h4">
                        <a href="#" class="mr-5">Have a Code?</a>

                        <form action="/coupon" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="code" class="mr-3 form-control">
                                <button type="submit" class="btn btn-primary h-25">Apply</button>
                            </div>
                        </form>
                    </dl>
                @endif
        </div>
    </div>
</div>
