@extends('layouts.app')

@section('content')
<div class="blog-details content">
    <article class="blog-post-details">
        @if ($page->media->count() > 0)
        <div class="post-thumbnail">
            <img src=" {{ asset('assets/posts/'.$page->media->first()->path) }} " alt="{{ $page->title }}">
        </div>
        @endif

        <div class="post_wrapper">
            <div class="post_header">
                <h2>{{$page->title}}</h2>
                <div class="blog-date-categori">
                    {{-- <ul>
                        <li>{{$page->created_at->format('M d, Y ')}}</li>
                        <li><a href="#" title="Posts by boighor" rel="author">{{$page->user->name}}</a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="post_content">
                <p>
                    {{$page->content}}
                </p>
            </div>
        </div>
    </article>
</div>
@endsection
