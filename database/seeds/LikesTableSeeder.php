<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];
        for ($i = 1; $i<=10; $i++){
            $array[$i] = array_random(range(1, 61), rand(1, 25));
        }

        foreach ($array as $user_id => $value) {
            foreach ($value as $liked_id) {
                factory(App\Like::class)->create([
                    'user_id' => $user_id,
                    'liked_id' => $liked_id,
                ]);
            }
        }
    }
}
