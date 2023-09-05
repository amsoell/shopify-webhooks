<?php

use Amsoell\ShopifyWebhooks\Middleware\ValidateShopifyWebhooks;
use Orchestra\Testbench\TestCase;

class ShopifyWebhooksTests extends TestCase
{
    /** @test */
    public function it_blocks_requests_without_hmac_header()
    {
        $this->post('webhook-endpoint')->assertUnauthorized();
    }

    /** @test */
    public function it_approves_requests_with_valid_hmac_header()
    {
        $data = [
            'data' => 'test-data',
        ];

        $hmac = base64_encode(hash_hmac('sha256', json_encode($data), '', true));
        $this->call('post', 'webhook-endpoint', [], [], [], [
            'HTTP_X-Shopify-Hmac-SHA256' => $hmac,
        ], json_encode($data))
            ->assertOK();
    }

    /** @test */
    public function it_rejects_requests_with_invalid_hmac_header()
    {
        $data = [
            'data' => 'test-data',
        ];

        $hmac = base64_encode(hash_hmac('sha256', json_encode([]), '', true));
        $this->call('post', 'webhook-endpoint', [], [], [], [
            'HTTP_X-Shopify-Hmac-SHA256' => $hmac,
        ], json_encode($data))
            ->assertUnauthorized();
    }

    protected function defineRoutes($router)
    {
        $router->post('webhook-endpoint', fn () => [
            'successful' => true,
        ])->middleware(ValidateShopifyWebhooks::class);
    }
}
