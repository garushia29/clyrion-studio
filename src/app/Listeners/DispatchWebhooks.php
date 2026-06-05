<?php

namespace App\Listeners;

use App\Events\ModelActivity;
use App\Models\Webhook;
use App\Models\WebhookCall;
use Illuminate\Support\Facades\Http;

class DispatchWebhooks
{
    public function handle(ModelActivity $event): void
    {
        $model = $event->model;
        $action = $event->action;
        $modelName = class_basename($model);
        $eventName = strtolower($modelName) . '.' . $action;

        $webhooks = Webhook::active()->get();

        foreach ($webhooks as $webhook) {
            if (!$webhook->shouldFire($eventName)) {
                continue;
            }

            $payload = [
                'event' => $eventName,
                'model' => $modelName,
                'model_id' => $model->id,
                'action' => $action,
                'data' => $model->toArray(),
                'timestamp' => now()->toIso8601String(),
            ];

            try {
                $response = Http::timeout(10)
                    ->withHeaders($this->buildHeaders($webhook, $payload))
                    ->post($webhook->url, $payload);

                WebhookCall::create([
                    'webhook_id' => $webhook->id,
                    'event' => $eventName,
                    'url' => $webhook->url,
                    'payload' => $payload,
                    'response' => [
                        'status' => $response->status(),
                        'body' => substr($response->body(), 0, 5000),
                    ],
                    'status_code' => $response->status(),
                    'success' => $response->successful(),
                    'completed_at' => now(),
                ]);
            } catch (\Exception $e) {
                WebhookCall::create([
                    'webhook_id' => $webhook->id,
                    'event' => $eventName,
                    'url' => $webhook->url,
                    'payload' => $payload,
                    'response' => ['error' => $e->getMessage()],
                    'success' => false,
                    'completed_at' => now(),
                ]);
            }
        }
    }

    private function buildHeaders(Webhook $webhook, array $payload): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'User-Agent' => 'ClyrionStudio-Webhook/1.0',
        ];

        if ($webhook->secret) {
            $headers['X-Webhook-Signature'] = hash_hmac('sha256', json_encode($payload), $webhook->secret);
        }

        return $headers;
    }
}
