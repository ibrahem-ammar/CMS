@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my__account__wrapper">
                <h3 class="account__title">Reset Password</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="account__form">
                        <div class="input__box">
                            <label for="email">E-Mail Address <span>*</span></label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input__box">
                            <label for="password" >Password <span>*</span></label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input__box">
                            <label for="password-confirm">Confirm Password <span>*</span></label>
                            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                            <div class="form__btn">
                            <button type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
