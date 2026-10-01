<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class SyncPreferenceSegments
{
    /**
     * @param  list<int>  $segmentIds
     */
    public function handle(int $userId, array $segmentIds): void
    {
        $user = User::query()->with('preference')->find($userId);

        if ($user === null || $user->preference === null) {
            return;
        }

        $preferenceId = $user->preference->id;

        DB::table('preference_segment')->where('preference_id', $preferenceId)->delete();

        $rows = array_map(
            fn (int $segmentId): array => [
                'preference_id' => $preferenceId,
                'segment_id' => $segmentId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            $segmentIds,
        );

        if ($rows !== []) {
            DB::table('preference_segment')->insert($rows);
        }

        Cache::forget("user:{$userId}");
    }
}
