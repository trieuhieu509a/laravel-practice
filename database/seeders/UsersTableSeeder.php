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
        $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);
        \App\Models\User::factory()->state([
            'name' => 'John Doe',
            'email' => 'john@laravel.test',
        ])->create();
        \App\Models\User::factory($usersCount)->create();

    }
}
