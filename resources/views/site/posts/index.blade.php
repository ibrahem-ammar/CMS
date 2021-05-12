@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-page">

        @forelse ($posts as $post)
        <article class="blog__post d-flex flex-wrap">
            @if ($post->media->count() > 0)
            <div class="thumb">
                <a href="blog-details.html">
                    <img src=" {{ asset('assets/posts/'.$post->media->first()->path) }} " alt="{{ $post->title }}">
                </a>
            </div>
            @endif
            <div class="content">
                <h4><a href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a></h4>
                <ul class="post__meta">
                    <li>Posts by : <a href="#">{{$post->user->name}}</a></li>
                    <li class="post_separator">/</li>
                    <li>{{$post->created_at->format('M d Y')}}</li>
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
            <h2 class="text-center">no posts yet</h2>
        @endforelse

    </div>
    {!! $posts->appends(request()->input())->links() !!}
</div>
@include('layouts.partials.sidemenu')

@endsection
