@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-md-3 col-sm-12">
    <div class="my__account__wrapper">
        <h3 class="account__title">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="account__form">
                <div class="input__box">
                    <label for="username">Username <span>*</span></label>
                    <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>


                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input__box">
                    <label for="password">Password <span>*</span></label>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__btn">
                    <button type="submit">Login</button>
                    <label class="label-for-checkbox">
                        <input type="checkbox" name="remember" class="input-checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                </div>
                <a class="forget_pass" href="{{ route('password.request') }}">Lost your password?</a>
            </div>
        </form>
    </div>
</div>
@endsection
