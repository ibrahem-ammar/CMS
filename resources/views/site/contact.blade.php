@extends('layouts.app')

@section('content')

<section class="wn_contact_area bg--white pt--80 pb--80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title">Get in touch</h2>
                    <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
                    {!! Form::open(['route'=>'docontact','method'=>'post','id'=>'contact-form']) !!}
                        <div class="single-contact-form">
                            {!! Form::text('name', old('name'), ['placeholder' => 'Name']) !!}
                            @error('name') <span class="help-block text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="single-contact-form space-between">
                            {!! Form::email('email', old('email'), ['placeholder' => 'Email']) !!}
                            {!! Form::text('mobile', old('mobile'), ['placeholder' => 'Mobile']) !!}
                        </div>
                        <div class="single-contact-form space-between">
                            @error('email') <span class="help-block text-danger">{{ $message }}</span> @enderror
                            @error('mobile') <span class="help-block text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="single-contact-form">
                            {!! Form::text('subject', old('subject'), ['placeholder' => 'Subject']) !!}
                            @error('subject') <span class="help-block text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="single-contact-form message">
                            {!! Form::textarea('message', old('message'), ['placeholder'=>'Type your message here..']) !!}
                            @error('message') <span class="help-block text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="contact-btn">
                            {!! Form::submit("Send Email") !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
