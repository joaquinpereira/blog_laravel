<?php

namespace Database\Seeders;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Tag::factory(10)->create();
        Category::factory(10)->create();
        Post::factory(30)->create()
            ->each(function($post){
                $tags = Tag::all()->random(rand(0,4))->pluck('id');
                $post->tags()->attach($tags);
        }); 
    }
}
