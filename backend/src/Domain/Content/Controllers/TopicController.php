<?php

declare(strict_types=1);

namespace Domain\Content\Controllers;

use Domain\Content\Actions\ListTopics;
use Domain\Content\Data\ListTopicsData;
use Spatie\LaravelData\DataCollection;

final class TopicController
{
    public function index(ListTopicsData $data, ListTopics $action): DataCollection
    {
        return $action->handle($data);
    }
}
