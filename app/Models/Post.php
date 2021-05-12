<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\PostMedia;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{
    use Sluggable,SearchableTrait;
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $searchable = [
        'columns' => [
            'posts.title' => 10,
            'posts.content' => 10,
        ],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }
}
