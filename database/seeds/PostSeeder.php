<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use illuminate\Support\Str;


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
            $newPost->title = $faker->sentence(2);
            $newPost->content = $faker->paragraph(10);
            $slug = Str::slug($newPost->title,'-');

            $existingPost = Post::where('slug', $slug)->first();
            $baseSlug = $slug;
            $counter = 1;
            while($existingPost) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
                $existingPost = Post::where('slug', $slug)->first();
            }
            $newPost->slug = $slug;

            $newPost->user_id =1;

            $newPost->save();
        }
    }
}
