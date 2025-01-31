<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll($page = 1, $perPage = 10)
    {
        return Article::with(['author', 'comments', 'segments', 'categories'])
            ->paginate($perPage, ['*'], 'page', $page);
    }
}
