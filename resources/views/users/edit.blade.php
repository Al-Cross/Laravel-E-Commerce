@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <aside class="col-md-3">
                    <ul class="list-group">
                        <a class="list-group-item" href="{{ route('profile') }}"> Account overview  </a>
                        <a class="list-group-item" href="{{ route('orders.index') }}"> My Orders </a>
                        <a class="list-group-item" href="{{ route('wishlist', $user->id) }}"> My wishlist </a>
                        <a class="list-group-item active" href="{{ route('edit.profile', $user->id) }}">Settings </a>
                    </ul>
                </aside>

                <section class="section-content bg padding-y w-75">
                    <div class="container">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <header class="card-header">
                                    <h4 class="card-title mt-2">Edit Profile</h4>
                                </header>
                                <article class="card-body">
                                    <form action="{{ route('update.profile') }}" method="POST" role="form">
                                        @csrf
                                        @method('PATCH')

                                        <div class="form-row">
                                            <div class="col form-group">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name"
                                                        id="name"
                                                        value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-Mail Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                            <small>Leave this field blank, if you want to keep your password.</small>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input class="form-control"
                                                    type="text"
                                                    name="address"
                                                    id="address"
                                                    value="{{ old('address', $user->address) }}">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="city">City</label>
                                                <input type="text"
                                                        class="form-control"
                                                        name="city"
                                                        id="city"
                                                        value="{{ old('city', $user->city) }}">
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="country">Country</label>
                                                <input type="text"
                                                        class="form-control"
                                                        name="country"
                                                        id="city"
                                                        value="{{ old('country', $user->country) }}">
                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block"> Edit Profile </button>
                                        </div>
                                    </form>
                                </article>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
