@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <form action="{{ route('posts.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="title">title</label>
            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}}</textarea>
        </div>

        <div class="form-group">
            <label for="status">publish</label>
            <input type="checkbox" name="status" id="status" value="1" {{old('status')==1? 'checked' : ''}}>
            <label for="commentable">commentable</label>
            <input type="checkbox" name="commentable" id="commentable" value="1" {{old('commentable')==1? 'checked' : ''}}>
        </div>


        <button type="submit">save</button>
    </form>
</div>
@include('layouts.partials.sidemenu')
@endsection
