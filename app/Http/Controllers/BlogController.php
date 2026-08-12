<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->orderByDesc('published_at')
            ->orderBy('sort')
            ->paginate(12);

        return view('pages.blog.index', compact('articles'));
    }


    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();


        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->when(
                $article->category,
                fn ($query) => $query->where('category', $article->category)
            )
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();


        if ($relatedArticles->count() < 3) {

            $missing = 3 - $relatedArticles->count();

            $excludeIds = $relatedArticles
                ->pluck('id')
                ->push($article->id)
                ->all();


            $additionalArticles = Article::published()
                ->whereNotIn('id', $excludeIds)
                ->orderByDesc('published_at')
                ->limit($missing)
                ->get();


            $relatedArticles = $relatedArticles
                ->concat($additionalArticles);
        }


        return view('pages.blog.show', compact(
            'article',
            'relatedArticles'
        ));
    }
}