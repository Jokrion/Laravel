<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Suppression des images
        Storage::disk('local')->delete(Storage::allFiles());

        factory(App\Post::class, 10)->create()->each( function($post){
        	$post->category()->associate(rand(1, 5));

	        // On utilise Futurama sur lorempiscum pour récupérer des images aléatoirement
	        $link = str_random(12) . '.jpg';
	        $file = file_get_contents('http://lorempicsum.com/futurama/250/250/' . rand(1,9));
	        Storage::disk('local')->put($link, $file);

	        $post->picture()->create([
	            'title'=> 'Default',
	            'link'=> $link
	        ]);
        });
    }
}
