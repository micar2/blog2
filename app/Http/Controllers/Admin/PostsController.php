<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }
/*
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }
*/
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->save();

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'category_id' =>'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ]);

        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : null;
        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicación ha sido guardada');
    }
/*
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'category_id' =>'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : null;
        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->attach($request->tags);

        return back()->with('flash', 'La publicación ha sido creada');
    }
*/

}
