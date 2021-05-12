<?php

namespace App\Http\Controllers\Users;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store($slug,Request $request)
    {

        // dd($slug);
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required|email',
            'url' => 'required|url',
            'comment' => 'required|min:10'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $post = Post::whereSlug($slug)->whereType('post')->whereStatus(1)->first();

        if ($post) {
            $userId= auth()->check() ? auth()->id() : null ;

            $data = [
                'name'  => $request->name,
                'email' => $request->email,
                'url'   => $request->url,
                'ip_address'    => $request->ip(),
                'comment'   => $request->comment,
                'user_id'   => $userId,
                'post_id'   => $post->id,
            ];

            $post->comments()->create($data);

            return redirect()->back()->with([
                'massage'=>'comment added successfully',
                'type' => 'success'
                ]);
        }

        return redirect()->route('posts.index')->with([
            'massage'=>'some thing went wrong',
            'type' => 'danger'
            ]);
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
