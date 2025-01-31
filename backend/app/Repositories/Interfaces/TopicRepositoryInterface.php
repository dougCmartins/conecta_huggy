<?php

namespace App\Repositories\Interfaces;

interface TopicRepositoryInterface
{
    public function getAll($page = 1, $perPage = 10);
}
