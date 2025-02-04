<?php

namespace App\Repositories;

use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepositoryInterface;

class TopicRepository implements TopicRepositoryInterface
{
    public function getAll($page = 1, $perPage = 10)
    {
        return Topic::with(['user', 'category', 'posts'])
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getById($id) {
        return Topic::find($id);
    }

    public function getByIdWithRelations($id)
    {
        return Topic::with(['user', 'category'])
            ->find($id);
    }
}
