<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query();

        // Apply filters if provided
        if ($request->has('source')) {
            $articles->where('source', $request->input('source'));
        }

        if ($request->has('category')) {
            $articles->where('category', $request->input('category'));
        }

        if ($request->has('author')) {
            $articles->where('author', $request->input('author'));
        }

        if ($request->has('date')) {
            $articles->whereDate('published_at', $request->input('date'));
        }

        return response()->json($articles->paginate(10), 200);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article, 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['message' => 'Search query is required'], 400);
        }

        $articles = Article::where('title', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->get();

        return response()->json($articles, 200);
    }

    public function filter(Request $request)
    {
        $articles = Article::query();


        if ($request->has('sources')) {
            $sources = parseArrayInput($request->input('sources'));
            $articles->whereIn('source', $sources);
        }

        if ($request->has('categories')) {
            $categories = parseArrayInput($request->input('categories'));
            $articles->whereIn('category', $categories);
        }

        if ($request->has('authors')) {
            $authors = parseArrayInput($request->input('authors'));
            $articles->whereIn('author', $authors);
        }

        if ($request->has('date_range')) {
            $dateRange = explode(',', $request->input('date_range'));
            if (count($dateRange) === 2) {
                $articles->whereBetween('published_at', $dateRange);
            }
        }

        return response()->json($articles->paginate(10), 200);
    }
}
