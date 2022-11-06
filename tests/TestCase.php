<?php

namespace Tests;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function user(): User
    {
        return User::factory()->create();
    }

    protected function blogPost()
    {
        return BlogPost::factory()->create([
            'user_id' => $this->user()->id
        ]);
    }
}
