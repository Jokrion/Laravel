<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;

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

        DB::table('posts')->insert([
            [
                'post_type' => 'stage', 
                'title' => 'Stage de développement Angular', 
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat posuere molestie. Mauris non auctor ligula. Aliquam efficitur sem eget blandit euismod. Morbi at tincidunt lacus, nec condimentum nunc. Ut quam nunc, pellentesque et nibh ac, ornare sollicitudin nisl. Nam tempor rutrum ipsum, tempus imperdiet tellus sodales ut. Curabitur rutrum, metus eget egestas interdum, nisl nibh condimentum velit, et maximus libero mi a libero.',
                'start_date' => new Carbon(),
                'end_date' => new Carbon('first day of december 2018'),
                'price' => 100,
                'max_students' => 25,
                'status' => 'published'
            ],
            [
                'post_type' => 'formation', 
                'title' => 'Formation Laravel pour les nuls', 
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat posuere molestie. Mauris non auctor ligula. Aliquam efficitur sem eget blandit euismod. Morbi at tincidunt lacus, nec condimentum nunc. Ut quam nunc, pellentesque et nibh ac, ornare sollicitudin nisl. Nam tempor rutrum ipsum, tempus imperdiet tellus sodales ut. Curabitur rutrum, metus eget egestas interdum, nisl nibh condimentum velit, et maximus libero mi a libero.',
                'start_date' => new Carbon(),
                'end_date' => new Carbon('first day of january 2019'),
                'price' => 150,
                'max_students' => 20,
                'status' => 'published'
            ],
            [
                'post_type' => 'formation', 
                'title' => 'NodeJS et Cie.', 
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat posuere molestie. Mauris non auctor ligula. Aliquam efficitur sem eget blandit euismod. Morbi at tincidunt lacus, nec condimentum nunc. Ut quam nunc, pellentesque et nibh ac, ornare sollicitudin nisl. Nam tempor rutrum ipsum, tempus imperdiet tellus sodales ut. Curabitur rutrum, metus eget egestas interdum, nisl nibh condimentum velit, et maximus libero mi a libero.',
                'start_date' => new Carbon(),
                'end_date' => new Carbon('last day of december 2018'),
                'price' => 65,
                'max_students' => 15,
                'status' => 'published'
            ],
        ]);

        for($i = 1; $i < 4; $i++) {
            $post = App\Post::find($i);
            if($i == 1) $cat = 4;
            if($i == 2) $cat = 1;
            if($i == 3) $cat = 7;
            $post->category()->associate($cat);
            $post->save();

            $link = str_random(12) . '.jpg';
            $file = file_get_contents('https://loremflickr.com/250/250/' . rand(1,19));
            Storage::disk('public')->put($link, $file);

            $post->picture()->create([
                'title' => 'Default',
                'link' => $link
            ]);
        }

        factory(App\Post::class, 20)->create()->each( function($post){
            $cat = App\Category::find(rand(1, 6));
        	$post->category()->associate($cat);
            $post->save();

	        // On utilise Futurama sur lorempiscum pour récupérer des images aléatoirement
	        $link = str_random(12) . '.jpg';
	        $file = file_get_contents('https://loremflickr.com/250/250/' . rand(1,19));
	        Storage::disk('public')->put($link, $file);

	        $post->picture()->create([
	            'title' => 'Default',
	            'link' => $link
	        ]);
        });
    }
}
