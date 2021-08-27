@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my__account__wrapper">
                <h3 class="account__title">Register</h3>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="account__form">
                    <div class="input__box">
                            <label for="name">Name <span>*</span></label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input__box">
                            <label for="username">Username <span>*</span></label>
                            <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input__box">
                            <label for="email">Email <span>*</span></label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input__box">
                            <label for="mobile">Mobile <span>*</span></label>
                            <input id="mobile" type="text" class="@error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                            @error('mobile')
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

                        <div class="input__box">
                            <label for="image" >Image</label>
                            <input id="image" type="file" class="custom-file @error('image') is-invalid @enderror" name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input__box">
                            <label for="bio">Bio</label>
                            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="10">
                                {{ old('bio') }}
                            </textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form__btn">
                            <button type="submit">Register</button>
                            <label class="label-for-checkbox">
                                <input type="checkbox" name="receive_email" class="input-checkbox" id="receive_email" {{ old('receive_email') ? 'checked' : '' }}>
                                <span>Receive Email</span>
                            </label>
                            <label class="label-for-checkbox">
                                <input type="checkbox" name="remember" class="input-checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>
                        </div>
                        <a class="forget_pass" href="{{ route('login') }}">Login?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
