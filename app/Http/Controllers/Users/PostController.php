<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified'], ['only' => ['create', 'store','edit','update','destroy']]);
    }

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
        $categories = Category::whereStatus(1)->pluck('name','id');

        return view('site.posts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required',
            'content'       => 'required|min:50',
            'status'        => 'required',
            'comment_able'      => 'required',
            'category_id'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title'] = $request->title;
        $data['content'] = Purify::clean($request->content);
        $data['status'] = $request->status;
        $data['comment_able'] = $request->comment_able;
        // $data['user_id'] = auth()->id();
        $data['category_id'] = $request->category_id;

        $post = auth()->user()->posts()->create($data);

        if ($request->images && count($request->images) > 0) {

            $i = 1;
            foreach ($request->images as $image) {
                $image_name = $post->slug . '-' . time() . '-' . $i . '.' . $image->getClientOriginalExtension();

                $image_size = $image->getSize();

                $image_type = $image->getMimeType();

                $path = public_path('assets/posts/'.$image_name);

                Image::make($image->getRealPath())->resize(800,function($constraint)
                {
                    $constraint->aspectRatio();
                })->save($path,100);

                $post->media()->create([
                    'path' => $image_name ,
                    'type' => $image_type ,
                    'size' => $image_size ,
                ]);

                $i++;
            }

        }

        if ($post->status ==1) {
            Cache::forget('recent_posts');
        }

        return redirect()->route('posts.show',$post->slug)->with([
            'message' => 'Post Created Successfully',
            'type' => 'success'
        ]);
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

    public function edit($post_id)
    {
        $post = Post::whereSlug($post_id)->orWhere('id',$post_id)->whereUserId(auth()->id())->first();

        if ($post) {
            $categories = Category::whereStatus(1)->pluck('name','id');

            return view('site.posts.edit',compact('categories','post'));
        }

        return redirect()->route('index')->with([
            'message' => 'Post Not Found',
            'type' => 'danger',
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'title'         => 'required',
            'content'       => 'required|min:50',
            'status'        => 'required',
            'comment_able'      => 'required',
            'category_id'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::whereSlug($id)->orWhere('id',$id)->whereUserId(auth()->id())->first();

        if ($post) {

            $data['title'] = $request->title;
            $data['content'] = Purify::clean($request->content);
            $data['status'] = $request->status;
            $data['comment_able'] = $request->comment_able;
            $data['category_id'] = $request->category_id;

            $post->update($data);

            if ($request->images && count($request->images) > 0) {

                $i = 1;
                foreach ($request->images as $image) {
                    $image_name = $post->slug . '-' . time() . '-' . $i . '.' . $image->getClientOriginalExtension();

                    $image_size = $image->getSize();

                    $image_type = $image->getMimeType();

                    $path = public_path('assets/posts/'.$image_name);

                    Image::make($image->getRealPath())->resize(800,function($constraint)
                    {
                        $constraint->aspectRatio();
                    })->save($path,100);

                    $post->media()->create([
                        'path' => $image_name ,
                        'type' => $image_type ,
                        'size' => $image_size ,
                    ]);

                    $i++;
                }

            }

            if ($post->status ==1) {
                Cache::forget('recent_posts');
            }

            return redirect()->route('posts.show',$post->slug)->with([
                'message' => 'Post Updated Successfully',
                'type' => 'success'
            ]);
        }
        return redirect()->route('dashboard')->with([
            'message' => 'Post Not Found',
            'type' => 'danger'
        ]);
    }

    public function destroy($id)
    {
        $post = Post::whereSlug($id)->orWhere('id',$id)->whereUserId(auth()->id())->first();

        if ($post) {
            if ($post->media->count() > 0) {
                foreach ($post->media as $media) {
                    if (File::exists('assets/posts/'. $media->path)) {
                        unlink('assets/posts/'. $media->path);
                    }
                }
            }

            $post->delete();

            return redirect()->route('dashboard')->with([
                'message' => 'Post Deleted Successfully',
                'type' => 'success'
            ]);
        }
        return redirect()->route('dashboard')->with([
            'message' => 'Post Not Found',
            'type' => 'danger'
        ]);

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

