<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Sluggable;

class PostMedia extends Model
{
    use Sluggable;
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
