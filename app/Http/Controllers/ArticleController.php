<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ArticleRequest as Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::all();
        return response()->view('articles.index', compact('articles'));
    }

    /**
     * @return Response
     * @throws AuthorizationException
     */
    public function create()
    {
        if (Auth::user()->cant('create', Article::class)) {
            throw new AuthorizationException('Dont have authorization to create articles');
        }

        return response()->view('articles.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        if (Auth::user()->cant('create', Article::class)) {
            throw new AuthorizationException('Dont have authorization to create articles');
        }

        $article = Article::create($request->all());
        dd($article->all());
        return response()->redirectToRoute('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function show(Article $article)
    {
        return response()->view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function edit(Article $article)
    {
        return response()->view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Article  $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response($article);

        return response()->view('articles.show', compact('article'));
    }

    /**
     * @param Article $article
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->redirectToRoute('articles.list');
    }
}
