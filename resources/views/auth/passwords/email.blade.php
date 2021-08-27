@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="wn_checkout_wrap">
                <div class="checkout_info">
                    <span><label for="email"></label> Reset Password</span>
                </div>
                <div class="checkout_coupon" style="display: block;">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form__coupon">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" style="width:calc(100% - 221px);" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <button type="submit">Send Password Reset Link</button>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
