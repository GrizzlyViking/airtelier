<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function show(Article $article)
	{
		$article->load('offers', 'events');
		return view('frontend.article', compact('article'));
    }
}
