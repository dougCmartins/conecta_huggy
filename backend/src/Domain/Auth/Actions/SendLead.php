<?php

declare(strict_types=1);

namespace Domain\Auth\Actions;

use Domain\Auth\Data\LeadData;
use Domain\Auth\Data\SendLeadData;
use Domain\Auth\Exceptions\LeadDeliveryFailedException;
use Domain\Auth\Exceptions\LeadNotConfiguredException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class SendLead
{
    public function handle(SendLeadData $data): LeadData
    {
        $webhookUrl = config('services.zapier.webhook_url');

        if (! is_string($webhookUrl) || $webhookUrl === '') {
            throw new LeadNotConfiguredException();
        }

        $response = Http::asJson()->post($webhookUrl, [
            'nome' => $data->name,
            'email' => $data->email,
            'id_da_campanha' => config('services.zapier.campaign_id'),
            'lead_source' => config('services.zapier.lead_source'),
        ]);

        if (! $response->successful()) {
            throw new LeadDeliveryFailedException();
        }

        Log::info('Lead sent', ['email' => $data->email]);

        return new LeadData(delivered: true);
    }
}
