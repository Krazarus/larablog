<?php

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
        $admin = factory(App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin')
            ]);
        $users = factory(App\User::class, 10)->create();
        $users->each(function ($user) {
            factory(App\Post::class, 5)->create(['user_id' => $user->id]);
        });
    }
}
