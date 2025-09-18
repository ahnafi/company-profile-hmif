<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(9); // 9 articles per page (3x3 grid)

        return inertia('articles/index', [
            'articles' => $articles
        ]);
    }
}
