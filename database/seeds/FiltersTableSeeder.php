<?php

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ([
            'бублик',
            'ревербератор',
            'кастет',
            'хорь',
            'алкоголь',
            'превысокомногорассмотрительствующий',
            'гражданин',
            'паста'
        ]);
        foreach ($array as $name) {
            factory(App\Filter::class)->create([
                'name' => $name,
            ]);
        }

    }
}
