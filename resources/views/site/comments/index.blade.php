@extends('layouts.app')

@section('content')
<div class="col-lg-9 col-12">
    <div class="blog-page">

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td><a href="{{ route('posts.show', $comment->post->slug) }}">{{$comment->post->title}}</a></td>
                        <td>{{ $comment->status }}</td>
                        <td>
                            <a href="{{ route('comments.edit',$comment->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('comments.destroy',$comment->id) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault();if(confirm('Are you sure to delete this comment ?')){document.getElementById('delete-comment-{{ $comment->id }}').submit();}">
                                <i class="fa fa-trash"></i>
                            </a>

                            <form id="delete-comment-{{ $comment->id }}" action="{{ route('comments.destroy',$comment->id) }}" method="post" class="d-none">
                                @csrf
                                @method('delete')
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No comments Found</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {!! $comments->links() !!}
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
    @include('site.user.partials.sidemenu')
@endsection
