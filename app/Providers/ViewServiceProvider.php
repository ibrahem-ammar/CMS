<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
                    $recent_posts = Post::orderBy('id','DESC')->limit(5)
                        ->whereType('post')->whereStatus(1)->with('category','user','media')
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
                    $recent_comments = Comment::orderBy('id','DESC')
                        ->limit(5)->whereStatus(1)->with('post')->get();

                    Cache::add('recent_comments', $recent_comments, 3600);

                    // Cache::remember('recent_comments', 3600, function () use ($recent_comments){
                    //     return $recent_comments;
                    // });

                }

                if (!Cache::has('global_categories')) {
                    $global_categories = Category::orderBy('id','DESC')->limit(5)->whereStatus(1)->get();

                    Cache::add('global_categories', $global_categories, 3600);

                    // Cache::remember('global_categories', 3600, function () use ($global_categories){
                    //     return $global_categories;
                    // });

                }

                if (!Cache::has('global_archives')) {
                    $global_archives = Post::whereType('post')->whereStatus(1)->orderBy('created_at','DESC')
                        ->select(DB::raw('Year(created_at) as year'),DB::raw('Month(created_at) as month'))
                        ->pluck('year','month')->toArray();

                    Cache::add('global_archives', $global_archives, 3600);

                    // Cache::remember('global_archives', 3600, function () use ($global_archives){
                    //     return $global_archives;
                    // });

                }

                $recent_posts = Cache::get('recent_posts');
                $recent_comments = Cache::get('recent_comments');
                $global_categories = Cache::get('global_categories');
                $global_archives = Cache::get('global_archives');

                $view->with([
                    'recent_posts' => $recent_posts,
                    'recent_comments' => $recent_comments,
                    'global_categories' => $global_categories,
                    'global_archives' => $global_archives,
                ]);

            });
        }
    }
}
