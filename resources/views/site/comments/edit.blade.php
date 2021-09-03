@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-details content">
        <div class="comment_respond" id="add_comment_section">

            {!! Form::open(['route'=>['comments.update',$comment->id],'method'=>'put','class'=>"comment__form"]) !!}
                <h3>Edit comment on : {{ $comment->post->title }}</h3>
                <p>Your email address will not be published.Required fields are marked </p>

                <div class="input__box">
                    {!! Form::label('comment', 'Comment') !!}
                    {!! Form::textarea('comment', old('comment',$comment->comment)) !!}
                    @error('comment') <span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input__wrapper clearfix">
                    <div class="input__box name one--third">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name',$comment->name), ['placeholder' => 'name ...']) !!}
                        @error('name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="input__box email one--third">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', old('email',$comment->email), ['placeholder' => 'email ...']) !!}
                        @error('email') <span class="help-block text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="input__box website one--third">
                        {!! Form::label('url', 'Url') !!}
                        {!! Form::text('url', old('url',$comment->url), ['placeholder' => 'url ...']) !!}
                        @error('url') <span class="help-block text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="input__box">
                    {!! Form::label('status', 'status') !!}
                    {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], old('status',$comment->status), ['class'=>'form-control']) !!}
                    @error('status') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="submite__btn">
                    {!! Form::button("Save Comment",['type'=>'submit']) !!}
                    {!! Form::button("Cancel Comment",['type'=>'reset','class'=>"cancel__btn"]) !!}
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>
@include('site.user.partials.sidemenu')


@endsection
