<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

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
        $fs = new Filesystem;
        $fs->cleanDirectory('storage/app/public');

        factory(App\Post::class, 10)->create()->each( function($post){
            $cat = App\Category::find(rand(1, 5));
        	$post->category()->associate($cat);
            $post->save();

	        // On utilise Futurama sur lorempiscum pour récupérer des images aléatoirement
	        $link = str_random(12) . '.jpg';
	        $file = file_get_contents('http://lorempicsum.com/futurama/250/250/' . rand(1,9));
	        Storage::disk('public')->put($link, $file);

	        $post->picture()->create([
	            'title'=> 'Default',
	            'link'=> $link
	        ]);
        });
    }
}
