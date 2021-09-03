@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-page">

        @forelse ($posts as $post)
        <article class="blog__post d-flex flex-wrap">
            @if ($post->media->count() > 0)
            <div class="thumb">
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img src=" {{ asset('assets/posts/'.$post->media->first()->path) }} " alt="{{ $post->title }}">
                </a>
            </div>
            @else
            <div class="thumb">
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img src=" {{ asset('assets/images/blog/blog-3/2.jpg') }} " alt="{{ $post->title }}">
                </a>
            </div>

            @endif
            <div class="content">
                <h4><a href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a></h4>
                <ul class="post__meta">
                    <li>Posts by : <a href="{{ route('posts.author',$post->user->username) }}">{{$post->user->name}}</a></li>
                    <li class="post_separator">/</li>
                    <li><a href="{{ route('posts.archive',$post->created_at->format('d-m-Y')) }}">{{$post->created_at->format('M d Y')}}</a></li>
                </ul>
                <p>
                    {!! \Illuminate\Support\Str::limit($post->content,145,'...') !!}
                </p>
                <div class="blog__btn">
                    <a href="{{ route('posts.show', $post->slug) }}">read more</a>
                </div>
            </div>
        </article>
        @empty
            <h2 class="text-capitalize">No Posts Found</h2>
        @endforelse

    </div>
    {!! $posts->appends(request()->input())->links() !!}
</div>
@include('layouts.partials.sidemenu')

@endsection
