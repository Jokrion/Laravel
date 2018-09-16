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
    	DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@admin.fr',
            'password'=> Hash::make('admin'),
            'type' => 'admin',
            'remember_token' => str_random(10)
        ]);
        factory(App\User::class, 5)->create();
    }
}
