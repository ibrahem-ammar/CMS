@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link href="{{ asset('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous"> --}}
@endsection

@section('content')
<div class="col-lg-9 col-12">
    <h3>Edit Post ( {{ $post->title }} )</h3>
    {!! Form::open(['route'=>['posts.update',$post->id],'method'=>'put','files'=>'true']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', old('title',$post->title), ['class'=>'form-control','placeholder' => 'Title ...']) !!}
            @error('title') <span class="help-block text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', old('content',$post->content), ['class'=>'form-control summernote']) !!}
            @error('content') <span class="help-block text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    {!! Form::label('category_id', 'Category') !!}
                    {!! Form::select('category_id', [''=>'---'] + $categories->toArray(), old('category_id',$post->category_id), ['class'=>'form-control']) !!}
                    @error('category_id') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {!! Form::label('comment_able', 'comment Able') !!}
                    {!! Form::select('comment_able', ['1'=>'Yes','0'=>'No'], old('comment_able',$post->comment_able), ['class'=>'form-control']) !!}
                    @error('comment_able') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {!! Form::label('status', 'status') !!}
                    {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], old('status',$post->status), ['class'=>'form-control']) !!}
                    @error('status') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row py-4">
            <div class="col-12">
                <div class="file-loading">
                    {!! Form::file('images[]', ['id' =>'post-images','multiple'=>'multiple']) !!}
                </div>
            </div>
        </div>



        <div class="form-group">
            {!! Form::submit("Save Post",['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>
@include('site.user.partials.sidemenu')
@endsection



@section('script')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/themes/fa/theme.min.js') }}"></script>

    <script>
    $(function () {
        $('.summernote').summernote({
            placeholder: 'Content ...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#post-images').fileinput({
            theme: "fa",
            maxFileCount: 5,
            allowesFileTypes: ['images'],
            ShowCancel: true,
            ShowRemove: false,
            ShowUpload: false,
            overwriteInitial: false,
            initialPreview: [
                @if ($post->media->count() > 0)
                    @foreach ($post->media as $media)
                        "{{ asset('assets/posts/' . $media->path) }}",
                    @endforeach
                @endif

            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                @if ($post->media->count() > 0)
                    @foreach ($post->media as $media)
                        {
                            caption: "{{ $media->path }}",
                            size: "{{ $media->size }}",
                            width: "200px",
                            url: "{{ route('posts.media.destroy',[$media->id,'_token' => csrf_token()]) }}",
                            key: "{{ $media->id }}"
                        },
                    @endforeach
                @endif
            ]
        });
    });

    </script>



@endsection

