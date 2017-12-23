<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        @mkdir('public/images');

        $files = glob('public/images/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }


        $this->call(UsersTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
    }
}
