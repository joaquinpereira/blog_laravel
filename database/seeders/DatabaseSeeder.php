<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');

        User::factory(1)->create();
        Tag::factory(10)->create();
        Category::factory(10)->create();

        Post::factory(30)->create()
            ->each(function($post){
                $tags = Tag::all()->random(rand(0,4))->pluck('id');
                $post->tags()->attach($tags);
        }); 
    }
}
