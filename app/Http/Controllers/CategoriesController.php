<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate();
        $title = "Publicaciones de la categoría " . $category->name;

        return view('welcome', compact('posts', 'title'));
    }
}
