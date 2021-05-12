<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        ->with('category','user','media')
        ->whereHas('category',function($q) use ($slug){
            $q->whereStatus(1)->whereSlug($slug);
        })->whereHas('user',function($q){
            $q->whereStatus(1);
        })->paginate(5);

        return view('site.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('site.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::whereSlug($slug)->whereType('post')->whereStatus(1)
        ->with('category','user','media','comments')
        ->whereHas('category',function($q){
            $q->whereStatus(1);
        })->whereHas('user',function($q){
            $q->whereStatus(1);
        })->first();

        // dd($post->category->name);

        return view('site.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
