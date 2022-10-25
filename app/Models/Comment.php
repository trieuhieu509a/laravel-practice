<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory, SoftDeletes, Taggable;

    protected $fillable = ['user_id', 'content'];

    // function name is blogPost ( camel case , laravel will look for blog_post_id
    // function name is post ( camel case , laravel will look for post_id
//    public function blogPost()
//    {
//        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
//        return $this->belongsTo('App\Models\BlogPost');
//
//    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function (Comment $comment) {
//            // dump($comment);
//            // dd(BlogPost::class);
//            if ($comment->commentable_type === BlogPost::class) {
//                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
//                Cache::tags(['blog-post'])->forget('mostCommented');
//            }
//        });
//
////        static::creating(function (Comment $comment) {
////            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
////            Cache::tags(['blog-post'])->forget('mostCommented');
////        });
//
////        static::addGlobalScope(new LatestScope);
//    }
}
