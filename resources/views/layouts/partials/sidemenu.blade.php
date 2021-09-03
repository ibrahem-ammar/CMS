
<?php

// dd($recent_posts->first);

?>

<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
    <div class="wn__sidebar">
        <!-- Start Single Widget -->
        <aside class="widget search_widget">
            <h3 class="widget-title">Search</h3>
            {!! Form::open(['route'=>'posts.search','method'=>'get']) !!}
                <div class="form-input">
                    {!! Form::text('search', old('search',request()->search), ['placeholder'=>"Search..."]) !!}
                    {!! Form::button('<i class="fa fa-search"></i>', ['type'=>'submit']) !!}
                </div>
            {!! Form::close() !!}
        </aside>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <aside class="widget recent_widget">
            <h3 class="widget-title">Recent Posts</h3>
            <div class="recent-posts">
                <ul>
                    @forelse ($recent_posts as $recent_post)
                    <li>
                        <div class="post-wrapper d-flex">
                            <div class="thumb">
                                @if ($recent_post->media->count() > 0)
                                <a href="{{ route('posts.show', $recent_post->slug) }}"><img src=" {{ asset('assets/posts/'. $recent_post->media->first()->path ) }} " alt="{{$recent_post->title}}"></a>
                                @else
                                <a href="{{ route('posts.show', $recent_post->slug) }}"><img src=" {{ asset('assets/images/blog/sm-img/1.jpg') }} " alt="blog images"></a>
                                @endif
                            </div>
                            <div class="content">
                                <h4><a href="{{ route('posts.show', $recent_post->slug) }}">{!! \Illuminate\Support\Str::limit($recent_post->title,20,'...') !!}</a></h4>
                                <p>{{$recent_post->created_at->format('M d, Y')}}</p>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li>
                        <div class="post-wrapper d-flex">
                            <div class="content">
                                <h4>no posts</h4>
                            </div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </aside>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <aside class="widget comment_widget">
            <h3 class="widget-title">Recent Comments</h3>
            <ul>
                @forelse ($recent_comments as $recent_comment)
                <li>
                    <div class="post-wrapper">
                        <div class="thumb">
                            <img src=" {{ get_gravatar($recent_comment->email,47) }}"  alt="{{ $recent_comment->name }}">
                        </div>
                        <div class="content">
                            <p>{{ $recent_comment->name }} says :</p>
                            <a href="{{ route('posts.show', $recent_comment->post->slug) }}">{!! \Illuminate\Support\Str::limit($recent_comment->comment,25,'...') !!}</a>
                        </div>
                    </div>
                </li>
                @empty
                <li>
                    <div class="post-wrapper">
                        <div class="content">
                            <p>no comments</p>
                        </div>
                    </div>
                </li>
                @endforelse

            </ul>
        </aside>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <aside class="widget category_widget">
            <h3 class="widget-title">Categories</h3>
            <ul>
                @forelse ($global_categories as $category)
                <li><a href="{{ route('posts.category', $category->slug) }}">{{$category->name}}</a></li>
                @empty
                <li>no categories</li>
                @endforelse
            </ul>
        </aside>
        <!-- End Single Widget -->
        <!-- Start Single Widget -->
        <aside class="widget archives_widget">
            <h3 class="widget-title">Archives</h3>
            <ul>

                @forelse ($global_archives as $key => $value)
                    <li><a href="{{ route('posts.archive', $key.'-'.$value) }}">{{ date("F", mktime(0,0,0,$key,1)) . ' ' . $value }}</a></li>
                @empty
                    <li><p>No Posts Found</p></li>
                @endforelse
            </ul>
        </aside>
        <!-- End Single Widget -->
    </div>
</div>
