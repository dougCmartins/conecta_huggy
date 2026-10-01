<?php

declare(strict_types=1);

namespace Domain\Content\Actions;

use Domain\Content\Data\ArticleData;
use Domain\Content\Data\ListArticlesData;
use Domain\Content\Models\Article;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\DataCollection;

final class ListArticles
{
    /**
     * @return DataCollection<int, ArticleData>
     */
    public function handle(ListArticlesData $data): DataCollection
    {
        $articles = Article::query()
            ->with('author')
            ->orderByDesc('id')
            ->forPage($data->page, $data->perPage)
            ->get()
            ->map(fn (Article $article): ArticleData => new ArticleData(
                id: (int) $article->id,
                title: $article->title,
                subtitle: $article->subtitle,
                content: $article->content,
                image: $article->image,
                published: (bool) $article->published,
                created_at: $article->created_at?->toIso8601String() ?? '',
                author_name: (string) $article->author?->name,
            ))
            ->all();

        Log::info('Articles listed', ['count' => count($articles)]);

        return new DataCollection(ArticleData::class, $articles);
    }
}
