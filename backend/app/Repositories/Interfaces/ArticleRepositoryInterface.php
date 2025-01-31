<?php

namespace App\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAll($page = 1, $perPage = 10);
}
