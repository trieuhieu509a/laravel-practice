<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('posts.update', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });
        // Gate::allows('posts.update', $post);
        // $this->authorize('posts.update',)
//
//        Gate::define('posts.delete', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });


        // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');

//        Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        // posts.create, posts.view, posts.update, posts.delete
        // comments.create, comments.update etc.


        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
            return false;
        });

        // Gate::after(function ($user, $ability, $result) {
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
