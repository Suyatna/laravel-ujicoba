<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Post;

class KategoriController extends Controller
{
    public function show(Request $request, $nama)
    {
        $categories = Categories::where('slug', $nama)->orderBy('id', 'desc')->get();
        $posts      = Post::where('categories_id', $categories[0]->id)->get();


        return view('kategori/muncul', compact('posts'));
    }
}
