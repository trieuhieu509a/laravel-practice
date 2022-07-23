<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BlogPost
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $content
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlogPost extends Model
{
    protected $fillable = ['title', 'content'];

    use HasFactory;

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

//        static::deleting(function (BlogPost $blogPost) {
//            $blogPost->comments()->delete();
//        });
    }
}
