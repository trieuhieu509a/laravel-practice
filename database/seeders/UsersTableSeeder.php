<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->state([
            'name' => 'John Doe',
            'email' => 'john@laravel.test',
        ])->create();
        \App\Models\User::factory(20)->create();

    }
}
