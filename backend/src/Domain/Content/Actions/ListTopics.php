<?php

declare(strict_types=1);

namespace Domain\Content\Actions;

use Domain\Content\Data\ListTopicsData;
use Domain\Content\Data\TopicData;
use Domain\Content\Models\Topic;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\DataCollection;

final class ListTopics
{
    /**
     * @return DataCollection<int, TopicData>
     */
    public function handle(ListTopicsData $data): DataCollection
    {
        $topics = Topic::query()
            ->with(['user', 'category'])
            ->orderByDesc('id')
            ->forPage($data->page, $data->perPage)
            ->get()
            ->map(fn (Topic $topic): TopicData => new TopicData(
                id: (int) $topic->id,
                title: $topic->title,
                subtitle: $topic->subtitle,
                content: $topic->content,
                image: $topic->image,
                is_closed: (bool) $topic->is_closed,
                created_at: $topic->created_at?->toIso8601String() ?? '',
                author_name: (string) $topic->user?->name,
                category_name: (string) $topic->category?->name,
            ))
            ->all();

        Log::info('Topics listed', ['count' => count($topics)]);

        return new DataCollection(TopicData::class, $topics);
    }
}
