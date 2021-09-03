@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-details content">
        <article class="blog-post-details">
            @if ($post->media->count() > 0)
            <div class="post-thumbnail">
                <div id="postImagesIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($post->media as $item)
                            <li data-target="#postImagesIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($post->media as $item)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('assets/posts/'. $item->path) }}" class="d-block w-100" alt="{{ $post->title }}">
                            </div>
                        @endforeach
                    </div>

                    @if ($post->media->count() > 1)
                        <a class="carousel-control-prev" href="#postImagesIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#postImagesIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </div>
            @endif

            <div class="post_wrapper">
                <div class="post_header">
                    <h2>{{$post->title}}</h2>
                    <div class="blog-date-categori">
                        <ul>
                            <li>{{$post->created_at->format('M d, Y ')}}</li>
                            <li><a href="{{ route('posts.author',$post->user->username) }}" title="Posts by boighor" rel="author">{{$post->user->name}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="post_content">
                    <p>
                        {{$post->content}}
                    </p>
                </div>
                <ul class="blog_meta">
                    <li><a href="#">{{$post->active_comments->count()}} comment(s)</a></li>
                    <li> / </li>
                    <li>Category : <span>{{$post->category->name}}</span></li>
                </ul>
            </div>
        </article>
        @include('site.posts.includes.add_comment')

        <div class="comments_area mt-4">
            <h3 class="comment__title">{{$post->active_comments->count()}} comment(s)</h3>
            <ul class="comment__list">

                @forelse ($post->active_comments as $comment)
                <li>
                    <div class="wn__comment">
                        <div class="thumb">
                            <img src=" {{ get_gravatar($comment->email,46) }}" alt="User Avatar">
                        </div>
                        <div class="content">
                            <div class="comnt__author d-block d-sm-flex">
                                <span>
                                    @if ($comment->url)
                                    <a href="{{ $comment->url }}">{{ $comment->name }}</a>
                                    @else
                                    {{ $comment->name }}
                                    @endif
                                </span>
                                <span>{{ $comment->created_at->format('M d, Y h:i a') }}</span>
                                <div class="reply__btn">
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                </li>
                @empty
                    <p class="text-center"> no comments yet</p>
                @endforelse
            </ul>
        </div>


        {{-- @include('site.posts.includes.add_comment') --}}
    </div>
</div>
@include('layouts.partials.sidemenu')

@endsection
