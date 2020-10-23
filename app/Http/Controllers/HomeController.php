<?php

namespace App\Http\Controllers;

use App\Models\Article;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objArticle = new Article();
        $articles = $objArticle->orderBy('id', 'desc')->simplePaginate(3);

        return view('home', ['articles' => $articles]);

    }
    public function showArticle(int $id)
    {
        $objArticle = \App\Models\Article::find($id);
        if (!$objArticle) {
            return abort(404);
        }
        return view('show_article', ['article' => $objArticle]);
    }
}
