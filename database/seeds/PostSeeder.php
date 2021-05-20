<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++)
        {
            $newPost = new Post();
            $newPost->title = $faker->word();
            $newPost->content = $faker->paragraph(10);

            $slug = Str::slug($newPost->title, '-');
            $slugBase = $slug;
            $existingPost = Post::where('slug', $slug)->first();
            $counter = 1;
            while($existingPost) {
                $slug = $slugBase . '-' . $counter;
                $counter++;
                $existingPost = Post::where('slug', $slug)->first();
            };

            $newPost->user_id = 1;
            $newPost->slug = $slug;
            $newPost->save();
        }
    }
}
