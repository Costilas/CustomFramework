<?php

namespace Classes\Controllers;

use Classes\Models\News;
use Classes\Utility\HttpRequest\Request;
use Classes\Utility\Facades\View\View;

class NewsController extends Controller
{
    public function index(Request $request):void{

        $news = News::paginate(5, $request->get('page'), ['idate' => 'DESC']);
        $title = 'News';

        View::render('news/list', compact('news', 'title'));
    }


    public function single(Request $request, $id):void{
        $article = News::find($id);
        $title = "Single article $article->id";

        View::render('news/single', compact('article', 'title'));
    }
}