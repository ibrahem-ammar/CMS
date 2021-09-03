@extends('layouts.app')


@section('style')
    <link href="{{ asset('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-page">

        <h3>Update Information</h3>

        {!! Form::open(['route'=>['user.update',auth()->id()],'method'=>'put','name'=> 'user_info','files'=>true]) !!}

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name',auth()->user()->name),['class'=>'form-control']) !!}
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', old('email',auth()->user()->email),['class'=>'form-control']) !!}
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile') !!}
                        {!! Form::text('mobile', old('mobile',auth()->user()->mobile),['class'=>'form-control']) !!}
                        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('receive_email', 'Receive Emails') !!}<br/>
                        {!! Form::select('receive_email', [true=>'Yes',false=>'No'], old('receive_email',auth()->user()->receive_email), ['class'=>'form-control']) !!}
                        @error('receive_email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    {!! Form::label('bio', 'Bio') !!}<br/>
                    {!! Form::textarea('bio', old('bio',auth()->user()->bio), ['placeholder'=>'Type your bio here..','class' => 'form-control']) !!}
                    @error('bio') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12">
                    <div class="file-loading">
                        {!! Form::file('image', ['id' =>'user-avatar']) !!}
                    </div>
                </div>
            </div>

            {!! Form::button('Save', ['type'=>'submit','class'=> 'btn btn-primary']) !!}

        {!! Form::close() !!}

        <hr class="mt-3 mb-3">

        <h3>Update Password</h3>

        {!! Form::open(['route'=>['user.update.password'],'method'=>'put','name'=> 'user_password']) !!}

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('current_password', 'Current Password') !!}
                        {!! Form::password('current_password',['class'=>'form-control']) !!}
                        @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('password', 'New Password') !!}
                        {!! Form::password('password',['class'=>'form-control']) !!}
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirm Password') !!}
                        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>


            {!! Form::button('Save', ['type'=>'submit','class'=> 'btn btn-primary']) !!}


        {!! Form::close() !!}

    </div>
</div>
    @include('site.user.partials.sidemenu')
@endsection


@section('script')
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/themes/fa/theme.min.js') }}"></script>

    <script>
        $(function () {

            $('#user-avatar').fileinput({
                theme: "fa",
                maxFileCount: 1,
                allowesFileTypes: ['images'],
                ShowCancel: true,
                ShowRemove: true,
                ShowUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if (auth()->user()->image != null)
                            "{{ asset('assets/users/' . auth()->user()->image) }}",
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if (auth()->user()->image != null)
                            {
                                caption: "{{ auth()->user()->image }}",
                                width: "200px",
                                url: "{{ route('user.image.destroy',[auth()->user()->image,'_token' => csrf_token()]) }}",
                                key: "{{ auth()->user()->id }}"
                            }
                    @endif
                ]
            });
        });

        </script>
@endsection
