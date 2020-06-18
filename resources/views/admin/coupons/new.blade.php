@extends ('admin.app')

@section ('title', 'Register A Coupon')

@section ('content')
	<section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Register A New Coupon</h4>
                    </header>
                    <article class="card-body">
                        <form action="/admin/coupons/create" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="code" class="font-weight-bold">Coupon Code</label>
                                <input type="text"
                                        class="form-control @error('code') is-invalid @enderror"
                                        name="code">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group app-notification__footer">
                                <label for="type" class="font-weight-bold">Type</label>
                                <br>
                                <div>
                                    <input type="radio"
                                        class="@error('type') is-invalid @enderror"
                                        id="fixed"
                                        name="type"
                                        value="fixed"
                                        required> Fixed Value
                                    <div class="form-group reveal-if-active">
                                        <label for="amount" class="font-weight-bold">Amount</label>
                                        <input type="text"
                                                id="amount"
                                                class="form-control @error('value') is-invalid @enderror"
                                                name="value"
                                                data-require-pair="#fixed">
                                    </div>
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                     <input type="radio"
                                        class="@error('type') is-invalid @enderror"
                                        id="percent_off"
                                        name="type"
                                        value="percent"> Percent Off
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group reveal-if-active">
                                        <label for="percent" class="font-weight-bold">Percent Off</label>
                                        <input type="text"
                                                id="percent"
                                                class="form-control @error('percent_off') is-invalid @enderror"
                                                name="percent_off"
                                                data-require-pair="#percent_off">
                                    </div>
                                    @error('percent_off')
                                        <span class="" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                            	<button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
