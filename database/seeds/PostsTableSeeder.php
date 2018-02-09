<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $post = new Post;
        $post->title = 'Mi primer post';
        $post->slug = str_slug('Mi primer post');
        $post->excerpt = 'Extracto de mi primer post';
        $post->body = '<p>Contenido de mi primer post</p>';
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(['1', '2']);

        $post = new Post;
        $post->title = 'Mi segundo post';
        $post->slug = str_slug('Mi segundo post');
        $post->excerpt = 'Extracto de mi segundo post';
        $post->body = '<p>Contenido de mi segundo post</p>';
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 2;
        $post->save();

        $post->tags()->attach(['2', '3']);

        $post = new Post;
        $post->title = 'Mi tercer post';
        $post->slug = str_slug('Mi tercer post');
        $post->excerpt = 'Extracto de mi tercer post';
        $post->body = '<p>Contenido de mi tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(['3', '4']);

        $post = new Post;
        $post->title = 'Mi cuarto post';
        $post->slug = str_slug('Mi cuarto post');
        $post->excerpt = 'Extracto de mi cuarto post';
        $post->body = '<p>Contenido de mi cuarto post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 2;
        $post->save();

        $post->tags()->attach(['1', '4']);
    }
}
