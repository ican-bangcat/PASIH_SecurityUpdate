<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicNewsController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));

        $query = News::query()
            ->published()
            ->with('author')
            ->latest('published_at');

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $newsList = $query->paginate(6)->withQueryString();

        return view('pages.public.news.index', [
            'newsList' => $newsList,
            'search' => $search,
        ]);
    }

    public function show(string $slug): View
    {
        $news = News::query()
            ->published()
            ->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $recentNews = News::query()
            ->published()
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('pages.public.news.show', [
            'news' => $news,
            'recentNews' => $recentNews,
        ]);
    }
}
