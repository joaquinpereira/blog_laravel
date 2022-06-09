<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Spatie\Permission\Models\Role;
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

        $adminRol = Role::create(['name' => 'Admin']);
        $writerRol = Role::create(['name' => 'Writer']);

        $user = User::factory(1)->create([
            'name' => 'Joaquin Pereira',
            'email' => 'pereira.joaquin@gmail.com',
        ])->first();
        $user->assignRole($adminRol);

        $user = User::factory(1)->create([
            'name' => 'Jhon Smith',
            'email' => 'jhon@gmail.com',
        ])->first();
        $user->assignRole($writerRol);
        
        Tag::factory(10)->create();
        Category::factory(10)->create();

        Post::factory(30)->create()
            ->each(function($post){
                $tags = Tag::all()->random(rand(0,4))->pluck('id');
                $post->tags()->attach($tags);
        }); 
    }
}
