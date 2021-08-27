<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::whereType('post')->whereStatus(1)->with('category','user','media')
        ->whereHas('category',function($q){
            $q->whereStatus(1);
        })->whereHas('user',function($q){
            $q->whereStatus(1);
        })->orderBy('id','DESC')->paginate(5);
        return view('site.posts.index',compact('posts'));
    }



    public function create()
    {
        $categories = Category::all();

        return view('site.posts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $post = Post::whereSlug($slug)->whereType('post')->whereStatus(1)
            ->with([
                'category',
                'user',
                'media',
                'active_comments' => function($q) {
                    $q->orderBy('id','desc');
                }])
            ->whereHas('category',function($q){
                $q->whereStatus(1);
            })->whereHas('user',function($q){
                $q->whereStatus(1);
            })->first();

        // dd($post->active_comments);
        if ($post) {
            return view('site.posts.show',compact('post'));
        } else {
            abort(404);
        }


    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $posts = Post::whereType('post')->whereStatus(1)->search($request->search, null, true)
        ->with('category','user','media')
        ->whereHas('category',function($q){
            $q->whereStatus(1);
        })->whereHas('user',function($q){
            $q->whereStatus(1);
        })->paginate(5);
        return view('site.posts.index',compact('posts'));
    }

    public function category($slug)
    {
        $posts = Post::whereType('post')->whereStatus(1)
        ->whereHas('category',function($q) use ($slug){
            $q->whereStatus(1)->whereSlug($slug);
        })
        ->with('user','media')
        ->orderBy('id','desc')->paginate(5);

        return view('site.posts.index',compact('posts'));
    }

    public function archive($date)
    {
        $date = array_reverse(explode('-',$date)); ///  Year-Month-Day  ///
        $year = $date[0];
        $month = $date[1];
        $day = isset($date[2])? $date[2] : null;


        // dd($day,$month,$year);

        $posts = Post::whereType('post')->whereStatus(1)
        ->whereYear('created_at',$year)
        ->whereMonth('created_at',$month);
        if (isset($day)) {
            $posts = $posts->whereDay('created_at',$day);
        }
        $posts = $posts->with('user','media')
        ->orderBy('id','desc')->paginate(5);

        return view('site.posts.index',compact('posts'));

    }

    public function author($username)
    {
        $posts = Post::whereType('post')->whereStatus(1)
            ->whereHas('user',function($q) use ($username){
                $q->whereUsername($username);
            })
            ->with('user','media')
            ->orderBy('id','desc')->paginate(5);

        return view('site.posts.index',compact('posts'));
    }





}

