<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Data\ShowUserData;
use Domain\User\Data\UserData;
use Domain\User\Exceptions\UserNotFoundException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class ShowUser
{
    public function handle(ShowUserData $data): UserData
    {
        $userId = $data->id;

        $payload = Cache::remember(
            "user:{$userId}",
            now()->addMinutes(10),
            function () use ($userId): array {
                $user = User::query()->with('preference')->find($userId);

                if ($user === null) {
                    throw new UserNotFoundException();
                }

                return $this->payload($user);
            }
        );

        Log::info('User shown', ['user_id' => $userId]);

        return new UserData(
            id: $payload['id'],
            name: $payload['name'],
            email: $payload['email'],
            is_subscribed: $payload['is_subscribed'],
            segment_ids: $payload['segment_ids'],
        );
    }

    /**
     * @return array{id: int, name: string, email: string, is_subscribed: bool, segment_ids: list<int>}
     */
    public function payload(User $user): array
    {
        $preferenceId = $user->preference?->id;
        $segmentIds = [];

        if ($preferenceId !== null) {
            $segmentIds = DB::table('preference_segment')
                ->where('preference_id', $preferenceId)
                ->orderBy('segment_id')
                ->pluck('segment_id')
                ->map(fn (mixed $id): int => (int) $id)
                ->all();
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_subscribed' => (bool) $user->preference?->is_subscribed,
            'segment_ids' => $segmentIds,
        ];
    }
}
