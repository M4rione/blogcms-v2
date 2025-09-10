<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $author = User::factory()->create([
            'name' => 'Author',
            'email' => 'author@example.com',
            'password' => bcrypt('password'),
            'role' => 'author',
        ]);

        $categories = Category::factory(5)->create();
        $tags       = Tag::factory(12)->create();

        $posts = Post::factory(20)->create([
            'user_id' => $author->id,
            'category_id' => fn() => $categories->random()->id,
        ]);

        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(2,5))->pluck('id'));
        });
    }
}
