<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function show(PostMedia $postMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(PostMedia $postMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostMedia $postMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostMedia $media)
    {
        // $media = PostMedia::whereId($media_id)->first();
        if ($media) {
            if (File::exists('assets/posts/'. $media->path)) {
                unlink('assets/posts/'. $media->path);
            }

            $media->delete();

            return true;
        }
        return false;
    }
}
