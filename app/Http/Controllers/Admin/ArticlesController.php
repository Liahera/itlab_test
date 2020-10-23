<?php


namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    public function index()
    {
        $objArticle = new Article();
        $articles = $objArticle->get();
        return view('admin.articles.index', ['articles' => $articles]);
    }

    public function addArticle()
    {
        return view('admin.articles.add');

    }

    public function addRequestArticle(Request $request)
    {
        $objArticle = new Article();
        $user = Auth::user();
        $Text = $request->input('text') ?? null;
        $objArticle = $objArticle->create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);
        $objArticle->users()->save($user);
        if ($objArticle) {

            return redirect()->route('articles')->with('success', 'Статья успешно добавлена');
        }

        return back()->with('error', 'Не удалось добавить статью');
    }

    public function editArticle( $id)
    {

        $objArticle = Article::find($id);
      //  if (!$objArticle) {
        //    return abort(404);
       // }
        return view('admin.articles.edit', [
            'article' => $objArticle,
        ]);
    }

    public function editRequestArticle(int $id, Request $request)
    {
        $objArticle = Article::find($id);
        if (!$objArticle) {
            return abort(404);
        }

        $objArticle->title = $request->input('title');
        $objArticle->text = $request->input('text');


        if($objArticle->save()) {
            return redirect()->route('articles')->with('success', 'Статья успешно обновлена');
        }

        return back()->with('error' , 'Не удалось изменить статью');
    }

    public function deleteArticle(Request $request)
    {
        if ($request->ajax()) {
            $id = (int)$request->input('id');

            Article::where('id', $id)->delete();

            echo "success";
        }
    }
}
