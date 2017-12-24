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
        $array = [
            1 => [1, 4, 5, 8, 11, 23, 25, 28, 31, 44, 50, 53, 55, 58, 61],
            2 => [1, 2, 4, 7, 11, 23, 32, 43, 46, 49, 52, 55, 58, 59],
            3 => [1, 3, 5, 6, 8, 11, 15, 16, 18, 23, 33, 44, 49, 57, 59, 61],
            4 => [1, 4, 8, 9, 12, 16, 21, 34, 45, 53, 54, 55, 56, 58, 59, 60, 61],
            5 => [5, 25, 33, 45, 54, 56, 57, 58, 61],
            6 => [5, 33, 45, 47, 54, 55, 56, 57, 59, 61],
            7 => [1, 2, 5, 8, 11, 18, 24, 27, 34, 45, 58, 59, 60, 61],
            8 => [1, 5, 9, 14, 23, 34, 38, 39, 44, 59, 61],
            9 => [1, 5, 11, 19, 35, 44, 59, 61],
            10 => [1, 33, 35, 37, 38, 44, 47, 51, 52, 54, 55, 61]

        ];
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
