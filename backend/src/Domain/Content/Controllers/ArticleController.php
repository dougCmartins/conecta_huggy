<?php

declare(strict_types=1);

namespace Domain\Content\Controllers;

use Domain\Content\Actions\ListArticles;
use Domain\Content\Data\ListArticlesData;
use Spatie\LaravelData\DataCollection;

final class ArticleController
{
    public function index(ListArticlesData $data, ListArticles $action): DataCollection
    {
        return $action->handle($data);
    }
}
