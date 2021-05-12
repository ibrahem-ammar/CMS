@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-details content">
        <article class="blog-post-details">
            @if ($post->media->count() > 0)
            <div class="post-thumbnail">
                <img src=" {{ asset('assets/posts/'.$post->media->first()->path) }} " alt="{{ $post->title }}">
            </div>
            @endif

            <div class="post_wrapper">
                <div class="post_header">
                    <h2>{{$post->title}}</h2>
                    <div class="blog-date-categori">
                        <ul>
                            <li>{{$post->created_at->format('M d, Y ')}}</li>
                            <li><a href="#" title="Posts by boighor" rel="author">{{$post->user->name}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="post_content">
                    <p>
                        {{$post->content}}
                    </p>
                </div>
                <ul class="blog_meta">
                    <li><a href="#">{{$post->comments->count()}} comment(s)</a></li>
                    <li> / </li>
                    <li>Tags:<span>{{$post->category->name}}</span></li>
                </ul>
            </div>
        </article>
        <div class="comments_area">
            <h3 class="comment__title">{{$post->comments->count()}} comment(s)</h3>
            <ul class="comment__list">

                @forelse ($post->comments as $comment)
                <li>
                    <div class="wn__comment">
                        <div class="thumb">
                            @if ($post->user->image)
                            <img src=" {{ asset('assets/users/'.$post->user->image) }}" alt="comment images">
                            @else
                            <img src=" {{ asset('assets/users/1.jpeg') }}" alt="comment images">
                            @endif
                        </div>
                        <div class="content">
                            <div class="comnt__author d-block d-sm-flex">
                                <span><a href="#">{{ $comment->name }}</a> Post author</span>
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
                    <h3 class="text-center"> no comments yet</h3>
                @endforelse
            </ul>
        </div>
        <div class="comment_respond">
            <h3 class="reply_title">Leave a Reply <small><a href="#">Cancel reply</a></small></h3>

            <form class="comment__form" action="{{ route('comment.store',['slug'=>$post->slug]) }}" method="POST">
                @csrf
                <p>Your email address will not be published.Required fields are marked </p>
                <div class="input__box">
                    <textarea name="comment" placeholder="Your comment here">{{ old('comment')}}</textarea>
                    @error('comment') <span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="input__wrapper clearfix">
                    <div class="input__box name one--third">
                        <input type="text" placeholder="name" value="{{ old('name')}}" name="name">
                        @error('name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
                    <div class="input__box email one--third">
                        <input type="email" placeholder="email" value="{{ old('email')}}" name="email">
                        @error('email') <span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
                    <div class="input__box website one--third">
                        <input type="text" placeholder="website" value="{{ old('url')}}" name="url" >
                        @error('url') <span class="help-block text-danger">{{ $message }}</span>@enderror
                </div>
                </div>
                <div class="submite__btn">
                    <button type="submit">Post Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.partials.sidemenu')

@endsection
