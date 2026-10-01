<?php

declare(strict_types=1);

namespace Domain\Orchestrator\Auth\Actions;

use Domain\Orchestrator\Auth\Data\SyncUserPreferencesData;
use Domain\Segment\Actions\EnsureSegments;
use Domain\User\Actions\ApplyUserPreferences;
use Domain\User\Data\ApplyUserPreferencesData;
use Domain\User\Data\UserData;
use Illuminate\Support\Facades\DB;

final class SyncUserPreferences
{
    public function __construct(
        private readonly EnsureSegments $ensureSegments,
        private readonly ApplyUserPreferences $applyUserPreferences,
    ) {
    }

    public function handle(SyncUserPreferencesData $data): UserData
    {
        return DB::transaction(function () use ($data): UserData {
            $segmentIds = array_map('intval', $data->segment_ids);

            if ($segmentIds !== []) {
                $this->ensureSegments->handle($segmentIds);
            }

            return $this->applyUserPreferences->handle(new ApplyUserPreferencesData(
                name: $data->name,
                email: $data->email,
                is_subscribed: $data->is_subscribed,
                segment_ids: $segmentIds,
            ));
        });
    }
}
