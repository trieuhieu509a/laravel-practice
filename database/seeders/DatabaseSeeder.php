<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $doe = \App\Models\User::factory()->state([
             'name' => 'John Doe',
             'email' => 'john@laravel.test',
         ])->create();
        $else = \App\Models\User::factory(20)->create();

        $users = $else->concat([$doe]);
        //$users = $else->push($doe);

        $posts = BlogPost::factory(50)->make()->each(function(BlogPost $post) use ($users) {
//            $post->user_id = $users->random()->id;
//            $post->save();
            $post->user()->associate($users->random())->save();
        });

        $comments = Comment::factory(150)->make()->each(function (Comment $comment) use ($posts) {
//            $comment->blog_post_id = $posts->random()->id;
//            $comment->save();
            $comment->blogPost()->associate($posts->random())->save();
        });
    }
}
