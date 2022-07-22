<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();
        $posts = BlogPost::factory(50)->make()->each(function(BlogPost $post) use ($users) {
//            $post->user_id = $users->random()->id;
//            $post->save();
            $post->user()->associate($users->random())->save();
        });
    }
}
