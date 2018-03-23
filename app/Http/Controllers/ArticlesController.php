<?php

namespace App\Http\Controllers;

use App\Articles\Article;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    public function show(int $id): View
    {
        return view('articles.show', ['article' => Article::query()->find($id)]);
    }
}
