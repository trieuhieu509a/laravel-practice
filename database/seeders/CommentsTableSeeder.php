<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\BlogPost::all();
        $comments = Comment::factory(150)->make()->each(function (Comment $comment) use ($posts) {
//            $comment->blog_post_id = $posts->random()->id;
//            $comment->save();
            $comment->blogPost()->associate($posts->random())->save();
        });
    }
}
