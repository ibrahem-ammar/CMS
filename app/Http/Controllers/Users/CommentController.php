<?php

namespace App\Http\Controllers\Users;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'], ['only' => ['index','edit','update','destroy']]);
    }

    public function index()
    {
        $comments = auth()->user()->comments()->orderBy('id','desc')->paginate(10);


        return view('site.comments.index',compact('comments'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required|email',
            'url' => 'required|url',
            'comment' => 'required|min:10',
            'slug' => 'required|exists:posts,slug'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = $request->slug;

        $post = Post::whereSlug($slug)->whereType('post')->whereStatus(1)->first();

        if ($post) {
            $userId= auth()->check() ? auth()->id() : null ;

            $data = [
                'name'  => $request->name,
                'email' => $request->email,
                'url'   => $request->url,
                'ip_address'    => $request->ip(),
                'comment'   => Purify::clean($request->comment),
                'user_id'   => $userId,
                'status'    => 1 ,
                'post_id'   => $post->id,
            ];

            $post->comments()->create($data);

            Cache::forget('recent_comments');

            return redirect()->route('posts.show',$post->slug)->with([
                'message'=>'comment added successfully',
                'type' => 'success'
                ]);
        }

        return redirect()->route('posts.index')->with([
            'message'=>'some thing went wrong',
            'type' => 'danger'
            ]);
    }


    public function edit(Request $request,$comment_id)
    {
        $comment = auth()->user()->comments()->Where('id',$comment_id)->first();

        if ($comment) {
            return view('site.comments.edit',compact('comment'));
        }

        return redirect()->route('dashboard.comments')->with([
            'message' => 'Comment Not Found',
            'type' => 'danger',
        ]);
    }

    public function update(Request $request, $id)
    {

        // dd($id);

        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'comment' => 'required|min:10',
            'status' => 'required|boolean'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $comment = auth()->user()->comments()->where('id',$id)->first();

        if ($comment) {

            $data = [
                'name'  => $request->name,
                'email' => $request->email,
                'url'   => $request->url !='' ? $request->url : null ,
                'ip_address'    => $request->ip(),
                'comment'   => Purify::clean($request->comment),
                'status'    => $request->status,
            ];

            $comment->update($data);

            if ($request->status == 1) {
                Cache::forget('recent_comments');
            }

            return redirect()->route('dashboard.comments')->with([
                'message'=>'Comment Updated Successfully',
                'type' => 'success'
                ]);
        }

        return redirect()->route('dashboard.comments')->with([
            'message'=>'Comment Not Found',
            'type' => 'danger'
            ]);
    }

    public function destroy($id)
    {
        $comment = auth()->user()->comments()->Where('id',$id)->first();

        if ($comment) {

            $comment->delete();

            Cache::forget('recent_comments');

            return redirect()->route('dashboard.comments')->with([
                'message' => 'Comment Deleted Successfully',
                'type' => 'success'
            ]);
        }
        return redirect()->route('dashboard.comments')->with([
            'message' => 'Comment Not Found',
            'type' => 'danger'
        ]);

    }
}
