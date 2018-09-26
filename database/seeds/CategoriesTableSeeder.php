<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Category::class, 5)->create();
    	DB::table('categories')->insert([
            ['title' => 'PHP'],
            ['title' => 'CSS'],
            ['title' => 'HTML'],
            ['title' => 'Angular'],
            ['title' => 'JS'],
            ['title' => 'VueJS'],
            ['title' => 'NodeJS'],
        ]);
    }
}
