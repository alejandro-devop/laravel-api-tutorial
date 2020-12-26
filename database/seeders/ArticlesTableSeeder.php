<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Faker\Factory;
use Illuminate\Support\Facades\App;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::truncate();
        $faker = Factory::create();
        if (App::environment() !== 'testing') {
            for ($i=0; $i < 50; $i++) { 
                Article::create([
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                ]);
            }
        }        
    }
}
