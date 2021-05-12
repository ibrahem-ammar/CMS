<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!request()->is('admin/*')) {
            Paginator::defaultView('vendor.pagination.boighor');

            view()->composer('*',function($view)
            {
                if (!Cache::has('recent_posts')) {
                    $recent_posts = Post::orderBy('id','DESC')->limit(5)->whereType('post')->whereStatus(1)->with('category','user','media')
                    ->whereHas('category',function($q){
                        $q->whereStatus(1);
                    })->whereHas('user',function($q){
                        $q->whereStatus(1);
                    })->get();

                    Cache::add('recent_posts', $recent_posts, 3600);

                    // Cache::remember('recent_posts', 3600, function () use ($recent_posts){
                    //     return $recent_posts;
                    // });

                }

                if (!Cache::has('recent_comments')) {
                    $recent_comments = Comment::orderBy('id','DESC')->limit(5)->whereStatus(1)->with('post')->get();
                    Cache::add('recent_comments', $recent_comments, 3600);
                    // Cache::remember('recent_comments', 3600, function () use ($recent_comments){
                    //     return $recent_comments;
                    // });

                }

                if (!Cache::has('categories')) {
                    $categories = Category::orderBy('id','DESC')->limit(5)->whereStatus(1)->get();
                    Cache::add('categories', $categories, 3600);
                    // Cache::remember('categories', 3600, function () use ($categories){
                    //     return $categories;
                    // });

                }

                $recent_posts = Cache::get('recent_posts');
                $recent_comments = Cache::get('recent_comments');
                $categories = Cache::get('categories');

                $view->with([
                    'recent_posts' => $recent_posts,
                    'recent_comments' => $recent_comments,
                    'categories' => $categories,
                ]);

            });
        }
    }
}
