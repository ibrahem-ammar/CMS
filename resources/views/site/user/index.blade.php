@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-page">

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a></td>
                        <td>{{ $post->comments_count }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('posts.destroy',$post->id) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault();if(confirm('Are you sure to delete this post ?')){document.getElementById('delete-post-{{ $post->id }}').submit();}">
                                <i class="fa fa-trash"></i>
                            </a>

                            <form id="delete-post-{{ $post->id }}" action="{{ route('posts.destroy',$post->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Posts Found</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {!! $posts->links() !!}
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
    @include('site.user.partials.sidemenu')
@endsection
