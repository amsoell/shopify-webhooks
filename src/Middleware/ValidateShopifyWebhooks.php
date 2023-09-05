<?php

namespace Amsoell\ShopifyWebhooks\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ValidateShopifyWebhooks
{
    public function handle(Request $request, Closure $next)
    {
        $hmac_header = strval($request->header('X-Shopify-Hmac-SHA256'));
        $data = strval($request->getContent());

        if (! $this->verify_webhook($data, $hmac_header)) {
            return response([
                'error' => 'Invalid HMAC header',
            ], SymfonyResponse::HTTP_UNAUTHORIZED);
        }

        if ($driver = config('shopify-webhooks.logging.driver')) {
            Log::channel($driver)->log(
                config('shopify-webhooks.logging.level'),
                'Shopify webhook received',
                [
                    'headers' => $request->header(),
                    'body' => $request->all(),
                ],
            );
        }

        return $next($request);
    }

    private function verify_webhook(string $data, string $hmac_header): bool
    {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, config('shopify-webhook.signature'), true));

        return hash_equals($calculated_hmac, $hmac_header);
    }
}
